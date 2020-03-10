<?php
declare(strict_types=1);

namespace InstallHelper\Output;

use InstallHelper\Arguments\BaseArgument;

interface ValueRequiredMessageCallable
{
    public function printRequiredMessage(BaseArgument $argument): void;
}