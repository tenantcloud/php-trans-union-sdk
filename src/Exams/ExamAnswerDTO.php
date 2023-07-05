<?php

namespace TenantCloud\TransUnionSDK\Exams;

use TenantCloud\DataTransferObjects\CamelDataTransferObject;

/**
 * @method self   setQuestionKeyName(string $key)
 * @method self   setSelectedChoiceKeyName(string $key)
 * @method string getQuestionKeyName()
 * @method string getSelectedChoiceKeyName()
 */
final class ExamAnswerDTO extends CamelDataTransferObject
{
	protected array $fields = [
		'questionKeyName',
		'selectedChoiceKeyName',
	];
}
