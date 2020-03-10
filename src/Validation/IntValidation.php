<?php
declare(strict_types=1);

namespace InstallHelper\Validation;

class IntValidation implements ValidatingCallable
{

    public function validate(string $value = null): bool
    {
        if ($value === null) {
            $result = false;
        } else {
            $result = !(bool)preg_match('/\D/', $value); //if there is a sth else than 0-9, this will fail
        }

        if ($result === false) {
            echo 'input is not a number(int)';
        }
        return $result;
    }
}