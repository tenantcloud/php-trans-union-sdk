<?php

namespace TenantCloud\TransUnionSDK\Exams;

/**
 * Requested exam.
 */
final class ExamRequest
{
	/**
	 * @param ExamRequestQuestion[] $questions
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
	 * @return ExamRequestQuestion[]
	 */
	public function questions(): array
	{
		return $this->questions;
	}
}
