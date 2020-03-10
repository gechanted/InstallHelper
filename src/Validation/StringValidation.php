<?php
declare(strict_types=1);

namespace InstallHelper\Validation;

class StringValidation implements ValidatingCallable
{

    public function validate(string $value = null): bool
    {
        if ($value === null) {
            return false;
        }
        return true;
    }
}