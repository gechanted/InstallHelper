<?php
declare(strict_types=1);

namespace InstallHelper;

use InstallHelper\Arguments\BaseArgument;
use InvalidArgumentException;

class Arguments
{

    /**
     * @var Settings
     */
    private $settings;
    /**
     * @var NonSettings
     */
    private $nonSettings;
    /**
     * @var BaseArgument[]
     */
    private $baseArguments;

    /**
     * Arguments constructor.
     * @param Settings $settings
     * @param BaseArgument[] $baseArguments
     */
    public function __construct(Settings $settings, array $baseArguments)
    {
        $this->settings = $settings;
        $this->nonSettings = new NonSettings();
        $this->baseArguments = [];
        foreach ($baseArguments as $arg) {
            $this->baseArguments[$arg->getId()] = $arg;
        }
    }

    /**
     * @param string $key
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function get(string $key)
    {
        if (array_key_exists($key, $this->baseArguments)) {
            $arg = $this->baseArguments[$key];
            if ($arg->getUsage() === BaseArgument::USAGE_NON_SETTING) {
                if ($this->nonSettings->has($key)) {
                    return $this->nonSettings->get($key);
                }
            } elseif ($this->settings->has($key)) {
                return $this->settings->get($key);
            }
        }
        throw new InvalidArgumentException("key '$key' doesn't exist in the arguments");
    }

    public function getOr(string $key, $default)
    {
        try {
            return $this->get($key);
        } catch (InvalidArgumentException $exception) {
            return $default;
        }
    }

    public function getOrNull(string $key)
    {
        return $this->getOr($key, null);
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->baseArguments)
            && ($this->nonSettings->has($key)
                || $this->settings->has($key));
    }

    public function set(string $key, $value): void
    {
        if (array_key_exists($key, $this->baseArguments) === false) {
            throw new InvalidArgumentException("key '$key' doesn't exist in the arguments");
        }

        if ($this->baseArguments[$key]->getUsage() === BaseArgument::USAGE_SETTING) {
            $this->settings->set($key, $value);
        } else {
            $this->nonSettings->set($key, $value);
        }
    }

    public function getSettings(): Settings
    {
        return $this->settings;
    }
}