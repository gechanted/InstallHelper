<?php
declare(strict_types=1);

namespace InstallHelper;

use InvalidArgumentException;

class NonSettings
{

    /**
     * @var array
     */
    private $data;

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

}