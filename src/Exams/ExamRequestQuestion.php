<?php

namespace TenantCloud\TransUnionSDK\Exams;

/**
 * A question of {@see ExamRequest}.
 */
final class ExamRequestQuestion
{
	/**
	 * @param list<ExamRequestQuestionChoice> $choices
	 */
	public function __construct(
		private readonly string $key,
		private readonly string $text,
		private readonly array $choices
	) {}

	public function key(): string
	{
		return $this->key;
	}

	public function text(): string
	{
		return $this->text;
	}

	/**
	 * @return list<ExamRequestQuestionChoice>
	 */
	public function choices(): array
	{
		return $this->choices;
	}
}
