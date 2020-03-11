<?php
declare(strict_types=1);

namespace InstallHelper\Validation;

class ChoiceValidation implements ValidatingCallable
{

    /**
     * @var array
     */
    private $allowed;

    public function __construct(array $allowed)
    {
        $this->allowed = $allowed;
    }

    public function validate(string $value = null): bool
    {
        return in_array($value, $this->allowed, true);
    }
}