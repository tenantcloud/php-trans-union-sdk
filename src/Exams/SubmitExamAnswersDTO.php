<?php

namespace TenantCloud\TransUnionSDK\Exams;

use TenantCloud\DataTransferObjects\CamelDataTransferObject;

/**
 * @method self            setRequestRenterId(int $id)
 * @method self            setExamId(int $id)
 * @method self            setAnswers(ExamAnswerDTO[] $answers)
 * @method ExamAnswerDTO[] getAnswers()
 * @method int             getRequestRenterId()
 * @method int             getExamId()
 */
final class SubmitExamAnswersDTO extends CamelDataTransferObject
{
	protected array $fields = [
		'requestRenterId',
		'examId',
		'answers',
	];
}
