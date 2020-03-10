<?php
declare(strict_types=1);

namespace InstallHelper\Validation;

class BoolValidation implements ValidatingCallable
{

    public function validate(string $value = null): bool
    {
        if ($value !== null) {
            switch (mb_strtolower($value)) {
                case 'y' :
                case '1' :
                case 'yes' :
                case 'true' :
                case 'n' :
                case 'no' :
                case '0' :
                case 'false' :
                    return true;
            }
        }
        echo 'Please answer with y(es) or n(o) ... or 1 or true or 0 or false';
        return false;
    }
}