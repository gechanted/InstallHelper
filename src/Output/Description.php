<?php
declare(strict_types=1);

namespace InstallHelper\Output;

use InstallHelper\Arguments\BaseArgument;

class Description implements DescriptionCallable
{

    /**
     * @var string
     */
    private $description;

    public function __construct(string $description = '')
    {
        $this->description = $description;
    }

    public function printDescription(BaseArgument $argument): void
    {
        $string = $argument->getId() . ' - ';
        foreach ($argument->getCliAccessors() as $accessor) {
            if (strlen($accessor) === 1) {
                $string .= ' -' . $accessor;
            } else {
                $string .= ' --' . $accessor;
            }
            $string .= ' |';
        }
        $string = substr($string, 0, -1);

        $string .= '- ';
        $string .= '(' . $argument->getType() . ')';
        $string .= '(' . ($argument->isOptional() ? 'optional' : 'required') . ')';
        $string .= '(is used for the ' . ($argument->getUsage() === BaseArgument::USAGE_SETTING ? 'settings' : 'script') . ')';

        if ($this->description !== '') {
            $string .= ' - ';
            $string .= $this->description;
        }

        echo $string . PHP_EOL;
    }
}