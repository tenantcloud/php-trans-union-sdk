<?php

namespace TenantCloud\TransUnionSDK\Verification;

use TenantCloud\TransUnionSDK\Exams\ExamAnswerDTO;

/**
 * Factory for renter identity verification answers for the test mode.
 */
final class TestModeVerificationAnswersFactory
{
	/**
	 * 100% correct answers.
	 *
	 * @return array<ExamAnswerDTO>
	 */
	public function correct(): array
	{
		return [
			ExamAnswerDTO::create()
				->setQuestionKeyName('ACX_RCR_REL_CITY_DYNAMIC')
				->setSelectedChoiceKeyName('Alfred Ingram'),
			ExamAnswerDTO::create()
				->setQuestionKeyName('ACX_ID2_ASSOC_ST_NAME')
				->setSelectedChoiceKeyName('123rd'),
			ExamAnswerDTO::create()
				->setQuestionKeyName('ACX_RCR_HUNT_LIC_TYPE')
				->setSelectedChoiceKeyName('Deer'),
		];
	}

	/**
	 * 100% incorrect answers.
	 *
	 * @return array<ExamAnswerDTO>
	 */
	public function incorrect(): array
	{
		return [
			ExamAnswerDTO::create()
				->setQuestionKeyName('ACX_RCR_REL_CITY_DYNAMIC')
				->setSelectedChoiceKeyName('!(Alfred Ingram^Alwinaa Rafin^Joe Lawrence^Melvin Ruiz)'),
			ExamAnswerDTO::create()
				->setQuestionKeyName('ACX_ID2_ASSOC_ST_NAME')
				->setSelectedChoiceKeyName('!(123rd^Davis^Harding^Wilson)'),
			ExamAnswerDTO::create()
				->setQuestionKeyName('ACX_RCR_HUNT_LIC_TYPE')
				->setSelectedChoiceKeyName('!(Deer^Elk^Pheasant^Saltwater Snook)'),
		];
	}

	/**
	 * Answers to imitate "too many attempts" exception in test mode.
	 *
	 * @return array<ExamAnswerDTO>
	 */
	public function tooManyAttempts(): array
	{
		return [
			ExamAnswerDTO::create()
				->setQuestionKeyName('ACX_RCR_REL_CITY_DYNAMIC')
				->setSelectedChoiceKeyName('Melvin Ruiz'),
			ExamAnswerDTO::create()
				->setQuestionKeyName('ACX_ID2_ASSOC_ST_NAME')
				->setSelectedChoiceKeyName('Wilson'),
			ExamAnswerDTO::create()
				->setQuestionKeyName('ACX_RCR_HUNT_LIC_TYPE')
				->setSelectedChoiceKeyName('Saltwater Snook'),
		];
	}
}
