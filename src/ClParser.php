<?php
declare(strict_types=1);

namespace InstallHelper;

use InstallHelper\Arguments\BaseArgument;
use function cli\prompt;

class ClParser
{


    /**
     * @var BaseArgument[]
     */
    private $arguments = [];


    public function addArgument(BaseArgument $argument)
    {
        $this->arguments[] = $argument;
    }

    public function parse(Settings $settings): CliHelper
    {
        $parser = new \cli\Arguments();

        foreach ($this->arguments as $baseArgument) {
            if ($baseArgument->getType() === BaseArgument::TYPE_FLAG) {
                $parser->addFlag($baseArgument->getCliAccessors());
            } else {
                $parser->addOption($baseArgument->getCliAccessors());
            }
        }

        $parser->parse();
        $data = new Arguments($settings, $this->arguments);

        foreach ($this->arguments as $baseArgument)  {
            $cliAccessors = $baseArgument->getCliAccessors();
            if ($cliAccessors !== []) {

                reset($cliAccessors);
                $key = key($cliAccessors);
                $input = $parser->offsetGet($cliAccessors[$key]);
                var_dump($input, $baseArgument->getId());

                if ((isset($input) === false)) {
                    if ($settings->has($baseArgument->getId())) {
                        //do nothing ; value is already set
                        continue;
                    }
                }

                if ($baseArgument->getType() === BaseArgument::TYPE_FLAG && is_bool($input)) {
                    $data->set($baseArgument->getId(), Helper::convert($input, $baseArgument->getType()));
                    continue;
                }

                while (CallableHandler::callValidation($baseArgument->getValidation(), $input) === false) {
                    CallableHandler::callDescription($baseArgument->getDescription(), $baseArgument);
                    CallableHandler::callValueRequiredMessage($baseArgument->getValueRequiredMessage(), $baseArgument);
                    $input = prompt('');
                }
                $data->set($baseArgument->getId(), Helper::convert($input, $baseArgument->getType()));

            } elseif ($settings->has($baseArgument->getId())) {
                //do nothing ; value is already set
            } elseif ($baseArgument->isOptional()) {
                $data->set($baseArgument->getId(), $baseArgument->getDefault());
            } else {
                CallableHandler::callDescription($baseArgument->getDescription(), $baseArgument);
                CallableHandler::callValueRequiredMessage($baseArgument->getValueRequiredMessage(), $baseArgument);
                do {
                    $input = prompt('');
                } while (CallableHandler::callValidation($baseArgument->getValidation(), $input) === false);
                $data->set($baseArgument->getId(), Helper::convert($input, $baseArgument->getType()));
            }

        }

        return new CliHelper($this->arguments, $data);
    }

}