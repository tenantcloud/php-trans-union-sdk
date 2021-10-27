<?php

namespace TenantCloud\TransUnionSDK\Exams;

/**
 * Requested exam.
 */
final class ExamRequest
{
	private int $id;

	/** @var ExamRequestQuestion[] */
	private array $questions;

	/**
	 * @param ExamRequestQuestion[] $questions
	 */
	public function __construct(int $id, array $questions)
	{
		$this->id = $id;
		$this->questions = $questions;
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
