<?php
declare(strict_types=1);

namespace InstallHelper\Output;

use InstallHelper\Arguments\BaseArgument;

class ValueRequiredMessage implements ValueRequiredMessageCallable
{

    public function printRequiredMessage(BaseArgument $argument): void
    {
        echo 'Please specify ' . $argument->getId() . ': ';
    }
}