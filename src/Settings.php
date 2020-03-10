<?php
declare(strict_types=1);

namespace InstallHelper;

use InvalidArgumentException;

class Settings
{

    /**
     * @var array
     */
    private $data;
    /**
     * @var string
     */
    private $absoluteFileLocation;

    public function __construct(string $absoluteFileLocation)
    {
        if (is_readable($absoluteFileLocation) === false) {
            file_put_contents($absoluteFileLocation, '{}');
            $data = [];
        } else {
            $dataStr = file_get_contents($absoluteFileLocation);
            $data = json_decode($dataStr, true);
        }
        $this->data = $data;
        $this->absoluteFileLocation = $absoluteFileLocation;
    }


    public function getAll(): array
    {
        return $this->data;
    }

    /**
     * @param string $key
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function get(string $key)
    {
        if ($this->has($key)) {
            return $this->data[$key];
        }
        throw new InvalidArgumentException("key '$key' doesn't exist in the settings");
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
        return array_key_exists($key, $this->data);
    }

    public function set(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    public function save(): void
    {
        file_put_contents($this->absoluteFileLocation, json_encode($this->data));
    }
}