<?php

namespace TenantCloud\TransUnionSDK\Exams;

/**
 * A choice for one of possible answers for {@see ExamRequestQuestion}.
 */
final class ExamRequestQuestionChoice
{
	public function __construct(private string $key, private string $text)
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
}
