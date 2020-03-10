<?php
declare(strict_types=1);

namespace InstallHelper;

use InstallHelper\Arguments\BaseArgument;

class Helper
{


    public static function convert($value, string $type)
    {
        switch ($type) {
            case BaseArgument::TYPE_FLOAT :
                return (float) $value;
            case BaseArgument::TYPE_INT :
                return (int) $value;
            case BaseArgument::TYPE_STRING :
                return (string) $value;
            case BaseArgument::TYPE_BOOLEAN :
                return $value === 'y' || $value === 'yes' || $value === '1' || $value === 'true';
            case BaseArgument::TYPE_FLAG :
                return $value;
        }
    }
}