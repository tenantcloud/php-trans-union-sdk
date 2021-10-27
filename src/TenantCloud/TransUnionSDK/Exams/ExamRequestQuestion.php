<?php

namespace TenantCloud\TransUnionSDK\Exams;

/**
 * A question of {@see ExamRequest}.
 */
final class ExamRequestQuestion
{
	private string $key;

	private string $text;

	/** @var ExamRequestQuestionChoice[] */
	private array $choices;

	/**
	 * @param ExamRequestQuestionChoice[] $choices
	 */
	public function __construct(string $key, string $text, array $choices)
	{
		$this->key = $key;
		$this->text = $text;
		$this->choices = $choices;
	}

	public function key(): string
	{
		return $this->key;
	}

	public function text(): string
	{
		return $this->text;
	}

	/**
	 * @return ExamRequestQuestionChoice[]
	 */
	public function choices(): array
	{
		return $this->choices;
	}
}
