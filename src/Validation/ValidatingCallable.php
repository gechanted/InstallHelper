<?php
declare(strict_types=1);

namespace InstallHelper\Validation;

interface ValidatingCallable
{

    public function validate(string $value = null): bool ;
}