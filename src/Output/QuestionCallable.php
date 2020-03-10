<?php
declare(strict_types=1);

namespace InstallHelper\Output;

use InstallHelper\Arguments\BaseArgument;

interface QuestionCallable
{

    public function printQuestion($value, BaseArgument $argument): void;
}