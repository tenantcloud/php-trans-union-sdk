<?php

namespace Tests\TenantCloud\TransUnionSDK\Exams;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Utils;
use LogicException;
use Mockery;
use Psr\Http\Message\ResponseInterface;
use TenantCloud\TransUnionSDK\Exams\ExamAnswerDTO;
use TenantCloud\TransUnionSDK\Exams\ExamsApiImpl;
use TenantCloud\TransUnionSDK\Exams\ManualVerificationRequiredException;
use TenantCloud\TransUnionSDK\Exams\RequestExamDTO;
use TenantCloud\TransUnionSDK\Exams\SubmitExamAnswersDTO;
use TenantCloud\TransUnionSDK\Verification\TestModeVerificationAnswersFactory;
use Tests\TenantCloud\TransUnionSDK\TestCase;

/**
 * @see ExamsApiImpl
 */
class ExamsApiImplTest extends TestCase
{
	private TestModeVerificationAnswersFactory $answersFactory;

	protected function setUp(): void
	{
		parent::setUp();

		$this->answersFactory = new TestModeVerificationAnswersFactory();
	}

	/**
	 * @dataProvider requestThrowsManualVerificationRequiredExceptionWhenResponseIsProvider
	 *
	 * @param array<ResponseInterface> $arrayResponse
	 */
	public function testRequestThrowsManualVerificationRequiredExceptionWhenResponseIs(array $arrayResponse): void
	{
		$this->expectException(ManualVerificationRequiredException::class);

		$response = Mockery::mock(ResponseInterface::class);
		$response->expects()
			->getBody()
			->andReturn(Utils::streamFor(json_encode($arrayResponse)));

		$data = RequestExamDTO::create()
			->setRequestRenterId(123);

		$client = Mockery::mock(Client::class);
		$client->expects()
			->post('v1/ScreeningRequestRenters/123/Exams', [
				'json' => $data->toArray(),
			])
			->andReturn($response);

		(new ExamsApiImpl($client, true))->request($data);
	}

	/**
	 * @return array<array{array<string, mixed>}>
	 */
	public static function requestThrowsManualVerificationRequiredExceptionWhenResponseIsProvider(): iterable
	{
		return [
			[[
				'result'                  => 'SomethingElse',
				'authenticationQuestions' => [],
			]],
			[[
				'Results'                 => 'ManualVerificationRequired',
				'authenticationQuestions' => [
					[],
				],
			]],
			[[
				'results'                 => 'ManualVerificationRequired',
				'authenticationQuestions' => [
					[],
				],
			]],
			[[
				'result'                  => 'ManualVerificationRequired',
				'authenticationQuestions' => [
					[],
				],
			]],
		];
	}

	/**
	 * @dataProvider submitAnswersReplacesAnswersWithAllIncorrectIfAnyAnswerIsNoneOfTheAboveInTestModeProvider
	 *
	 * @param ExamAnswerDTO[] $answers
	 */
	public function testSubmitAnswersReplacesAnswersWithAllIncorrectIfAnyAnswerIsNoneOfTheAboveInTestMode(bool $expectedIncorrect, array $answers): void
	{
		$response = Mockery::mock(ResponseInterface::class);
		$response->expects()
			->getBody()
			->andReturn(Utils::streamFor(json_encode([
				'result' => '123',
			])));

		$data = SubmitExamAnswersDTO::create()
			->setAnswers($answers)
			->setRequestRenterId(123)
			->setExamId(456);

		$originalData = clone $data;

		if ($expectedIncorrect) {
			$data->setAnswers($this->answersFactory->incorrect());
		}

		$client = Mockery::mock(Client::class);
		$client->expects()
			->post('v1/ScreeningRequestRenters/123/Exams/456/Answers', [
				'json' => $data->toArray(),
			])
			->andReturn($response);

		(new ExamsApiImpl($client, true, true))->submitAnswers($originalData);

		self::assertEquals(
			$data->getAnswers(),
			$originalData->getAnswers(),
		);
	}

	/**
	 * @return array<array{bool, array<ExamAnswerDTO>}>
	 */
	public function submitAnswersReplacesAnswersWithAllIncorrectIfAnyAnswerIsNoneOfTheAboveInTestModeProvider(): iterable
	{
		$this->answersFactory = new TestModeVerificationAnswersFactory();

		return [
			[false, $this->answersFactory->correct()],
			[true, $this->answersFactory->incorrect()],
			[true, [
				ExamAnswerDTO::create()
					->setQuestionKeyName('ACX_RCR_REL_CITY_DYNAMIC')
					->setSelectedChoiceKeyName('Alfred Ingram'),
				ExamAnswerDTO::create()
					->setQuestionKeyName('ACX_ID2_ASSOC_ST_NAME')
					->setSelectedChoiceKeyName('123rd'),
				ExamAnswerDTO::create()
					->setQuestionKeyName('ACX_RCR_HUNT_LIC_TYPE')
					->setSelectedChoiceKeyName('!(Deer^Elk^Pheasant^Saltwater Snook)'),
			]],
			[true, [
				ExamAnswerDTO::create()
					->setQuestionKeyName('ACX_RCR_REL_CITY_DYNAMIC')
					->setSelectedChoiceKeyName('Alfred Ingram'),
				ExamAnswerDTO::create()
					->setQuestionKeyName('ACX_ID2_ASSOC_ST_NAME')
					->setSelectedChoiceKeyName('!(123rd^Davis^Harding^Wilson)'),
				ExamAnswerDTO::create()
					->setQuestionKeyName('ACX_RCR_HUNT_LIC_TYPE')
					->setSelectedChoiceKeyName('Deer'),
			]],
			[true, [
				ExamAnswerDTO::create()
					->setQuestionKeyName('ACX_RCR_REL_CITY_DYNAMIC')
					->setSelectedChoiceKeyName('!(Alfred Ingram^Alwinaa Rafin^Joe Lawrence^Melvin Ruiz)'),
				ExamAnswerDTO::create()
					->setQuestionKeyName('ACX_ID2_ASSOC_ST_NAME')
					->setSelectedChoiceKeyName('123rd'),
				ExamAnswerDTO::create()
					->setQuestionKeyName('ACX_RCR_HUNT_LIC_TYPE')
					->setSelectedChoiceKeyName('Deer'),
			]],
		];
	}

	/**
	 * @dataProvider submitAnswersDoesNotReplaceAnswersWithAllIncorrectIfAnyAnswerIsNoneOfTheAboveInNonTestModeProvider
	 *
	 * @param ExamAnswerDTO[] $answers
	 */
	public function testSubmitAnswersDoesNotReplaceAnswersWithAllIncorrectIfAnyAnswerIsNoneOfTheAboveInNonTestMode(array $answers): void
	{
		$response = Mockery::mock(ResponseInterface::class);
		$response->expects()
			->getBody()
			->andReturn(Utils::streamFor(json_encode([
				'result' => '123',
			])));

		$data = SubmitExamAnswersDTO::create()
			->setAnswers($answers)
			->setRequestRenterId(123)
			->setExamId(456);

		$client = Mockery::mock(Client::class);
		$client->expects()
			->post('v1/ScreeningRequestRenters/123/Exams/456/Answers', [
				'json' => $data->toArray(),
			])
			->andReturn($response);

		(new ExamsApiImpl($client, true, false))->submitAnswers($data);

		self::assertSame($answers, $data->getAnswers());
	}

	/**
	 * @return array<array{array<ExamAnswerDTO>}>
	 */
	public function submitAnswersDoesNotReplaceAnswersWithAllIncorrectIfAnyAnswerIsNoneOfTheAboveInNonTestModeProvider(): iterable
	{
		$this->answersFactory = new TestModeVerificationAnswersFactory();

		return [
			[$this->answersFactory->correct()],
			[$this->answersFactory->incorrect()],
			[[
				ExamAnswerDTO::create()
					->setQuestionKeyName('ACX_RCR_REL_CITY_DYNAMIC')
					->setSelectedChoiceKeyName('Alfred Ingram'),
				ExamAnswerDTO::create()
					->setQuestionKeyName('ACX_ID2_ASSOC_ST_NAME')
					->setSelectedChoiceKeyName('123rd'),
				ExamAnswerDTO::create()
					->setQuestionKeyName('ACX_RCR_HUNT_LIC_TYPE')
					->setSelectedChoiceKeyName('!(Deer^Elk^Pheasant^Saltwater Snook)'),
			]],
		];
	}

	public function testSubmitAnswersThrowsLogicExceptionIfReturnedStatusIsQuestioned(): void
	{
		$this->expectException(LogicException::class);
		$this->expectExceptionMessage('Unsupported "Questioned" result returned. Data: {"answers":[],"requestRenterId":123,"examId":456}, response: {"result":"Questioned"}');

		$response = Mockery::mock(ResponseInterface::class);
		$response->expects()
			->getBody()
			->andReturn(Utils::streamFor(json_encode([
				'result' => 'Questioned',
			])));

		$data = SubmitExamAnswersDTO::create()
			->setAnswers([])
			->setRequestRenterId(123)
			->setExamId(456);

		$client = Mockery::mock(Client::class);
		$client->expects()
			->post('v1/ScreeningRequestRenters/123/Exams/456/Answers', [
				'json' => $data->toArray(),
			])
			->andReturn($response);

		(new ExamsApiImpl($client, true))->submitAnswers($data);
	}

	public function testRequestReturnsAnExam(): void
	{
		$response = Mockery::mock(ResponseInterface::class);
		$response->expects()
			->getBody()
			->andReturn(Utils::streamFor(json_encode([
				'result'                  => 'OK',
				'examId'                  => 123,
				'authenticationQuestions' => [
					[
						'questionKeyName'     => 'question_key',
						'questionDisplayName' => 'question_text',
						'choices'             => [
							[
								'choiceKeyName'     => 'choice_key',
								'choiceDisplayName' => 'choice_text',
							],
						],
					],
				],
			])));

		$data = RequestExamDTO::create()
			->setRequestRenterId(789);

		$client = Mockery::mock(Client::class);
		$client->expects()
			->post('v1/ScreeningRequestRenters/789/Exams', [
				'json' => $data->toArray(),
			])
			->andReturn($response);

		$exam = (new ExamsApiImpl($client, true))->request($data);

		$this->assertSame(123, $exam->id());
		$this->assertCount(1, $exam->questions());
		$this->assertSame('question_key', $exam->questions()[0]->key());
		$this->assertSame('question_text', $exam->questions()[0]->text());
		$this->assertCount(1, $exam->questions()[0]->choices());
		$this->assertSame('choice_key', $exam->questions()[0]->choices()[0]->key());
		$this->assertSame('choice_text', $exam->questions()[0]->choices()[0]->text());
	}

	public function testThrowsTooManyAttemptsForFourthAnswerToEveryQuestion(): void
	{
		$this->expectException(ManualVerificationRequiredException::class);

		(new ExamsApiImpl(Mockery::mock(Client::class), true))
			->submitAnswers(
				SubmitExamAnswersDTO::create()
					->setAnswers($this->answersFactory->tooManyAttempts())
			);
	}
}
