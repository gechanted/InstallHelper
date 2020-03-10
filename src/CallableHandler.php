<?php
declare(strict_types=1);

namespace InstallHelper;

use InstallHelper\Arguments\BaseArgument;
use InstallHelper\Output\DescriptionCallable;
use InstallHelper\Output\QuestionCallable;
use InstallHelper\Output\ValueRequiredMessageCallable;
use InstallHelper\Validation\ValidatingCallable;

class CallableHandler
{

    /**
     * @param callable|DescriptionCallable|string $callable
     * @param BaseArgument $argument
     */
    public static function callDescription($callable, BaseArgument $argument): void
    {
        if (is_string($callable)) {
            echo $callable;
        } elseif ($callable instanceof DescriptionCallable) {
            $callable->printDescription($argument);
        } elseif (is_callable($callable)) {
            $callable($argument);
        } else {
            throw new \InvalidArgumentException('could not call callable');
        }
    }

    /**
     * @param callable|ValueRequiredMessageCallable|string $callable
     * @param BaseArgument $argument
     */
    public static function callValueRequiredMessage($callable, BaseArgument $argument): void
    {
        if (is_string($callable)) {
            echo $callable;
        } elseif ($callable instanceof ValueRequiredMessageCallable) {
            $callable->printRequiredMessage($argument);
        } elseif (is_callable($callable)) {
            $callable($argument);
        } else {
            throw new \InvalidArgumentException('could not call callable');
        }
    }

    /**
     * @param callable|ValidatingCallable|null $callable
     * @param string|null $input
     * @return bool
     */
    public static function callValidation($callable, string $input = null): bool
    {
        if ($callable === null) {
            return true;
        } elseif ($callable instanceof ValidatingCallable) {
            return $callable->validate($input);
        } elseif (is_callable($callable)) {
            return $callable($input);
        } else {
            throw new \InvalidArgumentException('could not call callable');
        }
    }

    /**
     * @param callable|QuestionCallable|string $question
     * @param BaseArgument $argument
     * @param mixed $value
     */
    public static function callQuestion($question, BaseArgument $argument, $value): void
    {
        if (is_string($question)) {
            echo $question;
        } elseif ($question instanceof QuestionCallable) {
            $question->printQuestion($value, $argument);
        } elseif (is_callable($question)) {
            $question($value, $argument);
        } else {
            throw new \InvalidArgumentException('could not call callable');
        }
    }
}