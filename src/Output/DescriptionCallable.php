<?php
declare(strict_types=1);

namespace InstallHelper\Output;

use InstallHelper\Arguments\BaseArgument;

interface DescriptionCallable
{

    public function printDescription(BaseArgument $argument): void;
}