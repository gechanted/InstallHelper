<?php
declare(strict_types=1);

namespace InstallHelper\Output;

use InstallHelper\Arguments\BaseArgument;

class Question implements QuestionCallable
{

    public function printQuestion($value, BaseArgument $argument): void
    {
        $string = $argument->getId() . ' is currently specified as ' . (is_bool($value) ? ($value ? 'true' : 'false') : "'$value'") . '. Do you want to change this?' ;
        echo $string;
    }
}