<?php

namespace TenantCloud\TransUnionSDK\Exams;

/**
 * A question of {@see ExamRequest}.
 */
final class ExamRequestQuestion
{
	/**
	 * @param ExamRequestQuestionChoice[] $choices
	 */
	public function __construct(private string $key, private string $text, private array $choices)
	{
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
