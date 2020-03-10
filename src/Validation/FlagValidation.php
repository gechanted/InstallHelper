<?php
declare(strict_types=1);

namespace InstallHelper\Validation;

class FlagValidation implements ValidatingCallable
{

    public function validate(string $value = null): bool
    {
        return true;
    }
}