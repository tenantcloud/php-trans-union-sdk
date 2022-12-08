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
	public function __construct(private int $id, private array $questions)
	{
	}

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
