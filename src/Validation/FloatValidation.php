<?php
declare(strict_types=1);

namespace InstallHelper\Validation;

class FloatValidation implements ValidatingCallable
{

    public function validate(string $value = null): bool
    {
        if ($value === null) {
            $result = false;
        } else {
            $result = !((bool)preg_match('/[^0-9.]/', $value) //if there is a sth else than 0-9 or a dot this will return true
                || (bool)preg_match('/\.[\s\S]*\./', $value)); // if there are 2 or more dots this will return true
        }

        if ($result === false) {
            echo 'input is not readable as a float: [0-9]*(.[0-9]*)?';
        }
        return $result;
    }
}