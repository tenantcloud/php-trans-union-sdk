<?php

namespace TenantCloud\TransUnionSDK\Exams;

/**
 * Exams (or so called renter identity verification) API.
 */
interface ExamsApi
{
	/**
	 * Request (start) an exam.
	 */
	public function request(RequestExamDTO $data): ExamRequest;

	/**
	 * Submit answers to an exam.
	 */
	public function submitAnswers(SubmitExamAnswersDTO $data): void;
}
