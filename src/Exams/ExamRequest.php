<?php

namespace TenantCloud\TransUnionSDK\Exams;

/**
 * Requested exam.
 */
final class ExamRequest
{
	/**
	 * @param list<ExamRequestQuestion> $questions
	 */
	public function __construct(
		private readonly int $id,
		private readonly array $questions
	) {}

	public function id(): int
	{
		return $this->id;
	}

	/**
	 * @return list<ExamRequestQuestion>
	 */
	public function questions(): array
	{
		return $this->questions;
	}
}
