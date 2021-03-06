<?php

namespace TenantCloud\TransUnionSDK\Fake;

use TenantCloud\TransUnionSDK\Exams\ExamRequest;
use TenantCloud\TransUnionSDK\Exams\ExamRequestQuestion;
use TenantCloud\TransUnionSDK\Exams\ExamRequestQuestionChoice;
use TenantCloud\TransUnionSDK\Exams\ExamsApi;
use TenantCloud\TransUnionSDK\Exams\FailedExamException;
use TenantCloud\TransUnionSDK\Exams\ManualVerificationRequiredException;
use TenantCloud\TransUnionSDK\Exams\RequestExamDTO;
use TenantCloud\TransUnionSDK\Exams\SubmitExamAnswersDTO;
use TenantCloud\TransUnionSDK\Verification\TestModeVerificationAnswersFactory;

/**
 * Part of {@see FakeTransUnionClient} TU client's implementation.
 */
final class FakeExamsApi implements ExamsApi
{
	/** @var int[] */
	private array $passedIds = [];

	private FakeTransUnionClient $client;

	private TestModeVerificationAnswersFactory $verificationAnswersFactory;

	public function __construct(FakeTransUnionClient $client)
	{
		$this->client = $client;
		$this->verificationAnswersFactory = new TestModeVerificationAnswersFactory();
	}

	/**
	 * {@inheritdoc}
	 */
	public function request(RequestExamDTO $data): ExamRequest
	{
		return new ExamRequest(random_int(1, PHP_INT_MAX), [
			new ExamRequestQuestion('ACX_RCR_REL_CITY_DYNAMIC', 'Which of the following people lives or owns property in HOT SPRINGS NATIONAL PARK?', [
				new ExamRequestQuestionChoice('Alfred Ingram', 'Alfred Ingram'),
				new ExamRequestQuestionChoice('Alwinaa Rafin', 'Alwinaa Rafin'),
				new ExamRequestQuestionChoice('Joe Lawrence', 'Joe Lawrence'),
				new ExamRequestQuestionChoice('Melvin Ruiz', 'Melvin Ruiz'),
				new ExamRequestQuestionChoice('!(Alfred Ingram^Alwinaa Rafin^Joe Lawrence^Melvin Ruiz)', 'None of the Above'),
			]),
			new ExamRequestQuestion('ACX_ID2_ASSOC_ST_NAME', 'Which of these street names are you associated with?', [
				new ExamRequestQuestionChoice('123rd', '123rd'),
				new ExamRequestQuestionChoice('Davis', 'Davis'),
				new ExamRequestQuestionChoice('Harding', 'Harding'),
				new ExamRequestQuestionChoice('Wilson', 'Wilson'),
				new ExamRequestQuestionChoice('!(123rd^Davis^Harding^Wilson)', 'None of the Above'),
			]),
			new ExamRequestQuestion('ACX_RCR_HUNT_LIC_TYPE', 'Which of the following hunting or fishing licenses do you have or have you had in the past?', [
				new ExamRequestQuestionChoice('Deer', 'Deer'),
				new ExamRequestQuestionChoice('Elk', 'Elk'),
				new ExamRequestQuestionChoice('Pheasant', 'Pheasant'),
				new ExamRequestQuestionChoice('Saltwater Snook', 'Saltwater Snook'),
				new ExamRequestQuestionChoice('!(Deer^Elk^Pheasant^Saltwater Snook)', 'None of the Above'),
			]),
		]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function submitAnswers(SubmitExamAnswersDTO $data): void
	{
		if ($data->getAnswers() == $this->verificationAnswersFactory->incorrect()) {
			throw new FailedExamException();
		}

		if ($data->getAnswers() == $this->verificationAnswersFactory->tooManyAttempts()) {
			throw new ManualVerificationRequiredException();
		}

		$this->passedIds[] = $data->getRequestRenterId();
	}

	/**
	 * Whether given request renter has successfully passed the verification.
	 */
	public function hasPassed(int $requestRenterId): bool
	{
		return in_array($requestRenterId, $this->passedIds, true);
	}

	/**
	 * Unpass verification (if passed previously) for given request renter id.
	 */
	public function unpass(int $requestRenterId): void
	{
		$this->passedIds = array_filter($this->passedIds, fn ($id) => $id !== $requestRenterId);
	}

	/**
	 * Unpass verification (if passed previously) for given renter (person) id.
	 */
	public function unpassByRenter(int $renterId): void
	{
		$requestRenterIds = $this->client
			->requests()
			->renters()
			->byRenter($renterId);

		foreach ($requestRenterIds as $id) {
			$this->unpass($id);
		}
	}
}
