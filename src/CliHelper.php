<?php
declare(strict_types=1);

namespace InstallHelper;

use InstallHelper\Arguments\BaseArgument;
use function cli\choose;
use function cli\prompt;

class CliHelper
{
    /**
     * @var array|BaseArgument[]
     */
    private $baseArguments;
    /**
     * @var Arguments
     */
    private $data;


    public function __construct(array $baseArguments, Arguments $data)
    {
        $this->baseArguments = $baseArguments;
        $this->data = $data;
    }

    /**
     * @param string $key
     * @throws \InvalidArgumentException
     */
    public function askForChange(string $key)
    {
        $argument = $this->getArgument($key);
        $value = $this->data->get($key);
        CallableHandler::callQuestion($argument->getQuestion(), $argument, $value);
        $input = choose('');
        if ($input === 'y' || $input === 'yes' || $input === '1' || $input === 'true') {
            $this->request($key);
        }
    }

    /**
     * @param string $key
     * @return BaseArgument
     * @throws \InvalidArgumentException
     */
    private function getArgument(string $key): BaseArgument
    {
        $result = array_filter($this->baseArguments, function (BaseArgument $argument) use ($key) {
            return $key === $argument->getId();
        });
        if ($result === []) {
            throw new \InvalidArgumentException("$key is not existing in Arguments");
        }
        $index = array_key_first($result);
        return $result[$index];
    }


    public function askAllForChange(): void
    {
        foreach ($this->baseArguments as $argument) {
            $this->askForChange($argument->getId());
        }
    }

    /**
     * @param string $key
     * @throws \InvalidArgumentException
     */
    public function request(string $key): void
    {
        $argument = $this->getArgument($key);
        CallableHandler::callDescription($argument->getDescription(), $argument);
        do {
            CallableHandler::callValueRequiredMessage($argument->getValueRequiredMessage(), $argument);
            $input = prompt('');
        } while (CallableHandler::callValidation($argument->getValidation(), $input) === false);
        $this->data->set($key, Helper::convert($input, $argument->getType()));
    }

    public function getData(): Arguments
    {
        return $this->data;
    }


}