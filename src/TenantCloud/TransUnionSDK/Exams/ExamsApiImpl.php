<?php

namespace TenantCloud\TransUnionSDK\Exams;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use LogicException;
use function TenantCloud\GuzzleHelper\psr_response_to_json;
use TenantCloud\TransUnionSDK\Verification\TestModeVerificationAnswersFactory;
use Tests\TenantCloud\TransUnionSDK\Exams\ExamsApiImplTest;

/**
 * Web API implementation of {@see ExamsApi}.
 *
 * @see ExamsApiImplTest
 */
final class ExamsApiImpl implements ExamsApi
{
	private const REQUEST_EXAM_API_PATH = 'v1/ScreeningRequestRenters/{request_renter_id}/Exams';
	private const SUBMIT_ANSWERS_API_PATH = 'v1/ScreeningRequestRenters/{request_renter_id}/Exams/{exam_id}/Answers';

	public function __construct(private readonly Client $httpClient, private readonly bool $imitateTooManyAttempts, private readonly bool $testMode = false)
	{
	}

	/**
	 * @inheritDoc
	 */
	public function request(RequestExamDTO $data): ExamRequest
	{
		$jsonResponse = $this->httpClient->post(
			str_replace('{request_renter_id}', (string) $data->getRequestRenterId(), self::REQUEST_EXAM_API_PATH),
			[
				'json' => $data->toArray(),
			]
		);

		$response = psr_response_to_json($jsonResponse);

		// I have no idea which key they actually use. TU told us it uses key "Results", however all of response
		// keys are lower case. Hence I'll also try "results". Request below on the other hand returns "result"
		// and I have no idea which one of those is a correct one since it can only be tested on production env.
		$result = Arr::get($response, 'Results') ?? Arr::get($response, 'results') ?? Arr::get($response, 'result');

		// If no questions were provided or they specifically told us manual verification is required - throw.
		// And no, those responses are not errors for some reason. They are returned as 200 OK.
		if ([] === Arr::get($response, 'authenticationQuestions', []) || $result === 'ManualVerificationRequired') {
			throw new ManualVerificationRequiredException();
		}

		return new ExamRequest(
			$response['examId'],
			array_map(
				fn ($questionData) => new ExamRequestQuestion(
					$questionData['questionKeyName'],
					$questionData['questionDisplayName'],
					array_map(
						fn ($choiceData) => new ExamRequestQuestionChoice(
							$choiceData['choiceKeyName'],
							$choiceData['choiceDisplayName']
						),
						$questionData['choices']
					)
				),
				$response['authenticationQuestions']
			)
		);
	}

	/**
	 * @inheritDoc
	 */
	public function submitAnswers(SubmitExamAnswersDTO $data): void
	{
		// If need to imitate too many attempts verification errors (as TU never returns it on non-production env),
		// we'll check if all of three answers provided are 4th answers to each question (out of 5 possible answers)
		// and if so - imitate TU's production behaviour on local/pipeline/staging env.
		// I wished there was another way, but unfortunately that's all we can do until TU fixes their shit.
		if (
			$this->imitateTooManyAttempts &&
			Arr::first($data->getAnswers(), fn (ExamAnswerDTO $answer) => $answer->getSelectedChoiceKeyName() === 'Melvin Ruiz') &&
			Arr::first($data->getAnswers(), fn (ExamAnswerDTO $answer) => $answer->getSelectedChoiceKeyName() === 'Wilson') &&
			Arr::first($data->getAnswers(), fn (ExamAnswerDTO $answer) => $answer->getSelectedChoiceKeyName() === 'Saltwater Snook')
		) {
			throw new ManualVerificationRequiredException();
		}

		// TransUnion's staging is inconsistent with their production environment in a way that their staging still has
		// so called "partial passes", which means that if you try to submit answers, one or two of which is
		// "None of the above" answer, TransUnion will neither fail the exam nor verificate the renter. Instead,
		// it will return "Questioned" status and more questions. As this is no longer used by TransUnion on their
		// production environment, but for whatever reason still is on their staging env, we'll have to swap the answers
		// with 100% incorrect answers so that we never get that "Questioned" status.
		if (
			$this->testMode &&
			(
				Arr::first($data->getAnswers(), fn (ExamAnswerDTO $answer) => $answer->getSelectedChoiceKeyName() === '!(Alfred Ingram^Alwinaa Rafin^Joe Lawrence^Melvin Ruiz)') ||
				Arr::first($data->getAnswers(), fn (ExamAnswerDTO $answer) => $answer->getSelectedChoiceKeyName() === '!(123rd^Davis^Harding^Wilson)') ||
				Arr::first($data->getAnswers(), fn (ExamAnswerDTO $answer) => $answer->getSelectedChoiceKeyName() === '!(Deer^Elk^Pheasant^Saltwater Snook)')
			)
		) {
			$data->setAnswers((new TestModeVerificationAnswersFactory())->incorrect());
		}

		$jsonResponse = $this->httpClient->post(
			str_replace(['{request_renter_id}', '{exam_id}'], [(string) $data->getRequestRenterId(), (string) $data->getExamId()], self::SUBMIT_ANSWERS_API_PATH),
			[
				'json' => $data->toArray(),
			]
		);

		$response = psr_response_to_json($jsonResponse);

		// Just in case, this check is here. Should never happen, as in production this is impossible (by their words),
		// and on staging (test mode) we make sure to never send such answers that would result in this status.
		if ($response['result'] === 'Questioned') {
			throw new LogicException('Unsupported "Questioned" result returned. Data: ' . json_encode($data->toArray()) . ', response: ' . json_encode($response));
		}

		if ($response['result'] === 'Failed') {
			throw new FailedExamException();
		}

		if ($response['result'] === 'ManualVerificationRequired') {
			throw new ManualVerificationRequiredException();
		}
	}
}
