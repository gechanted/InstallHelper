<?php
declare(strict_types=1);

namespace InstallHelper\Arguments;

class IntArgument extends BaseArgument
{

    public function __construct(
        string $id,
        array $cliAccessors = [],
        string $usage = BaseArgument::USAGE_SETTING,
        bool $optional = BaseArgument::USAGE_REQUIRED,
        $default = null
    ) {
        parent::__construct($id, $cliAccessors, BaseArgument::TYPE_INT, $usage, $optional, $default);
    }

    /**
     * @param string $id
     * @param string[] $cliAccessors
     * @return IntArgument
     */
    public static function newRequiredSetting(string $id, array $cliAccessors): IntArgument
    {
        return new self($id, $cliAccessors);
    }

    /**
     * @param string $id
     * @param string[] $cliAccessors
     * @param $default
     * @return IntArgument
     */
    public static function newOptionalSetting(string $id, array $cliAccessors, $default): IntArgument
    {
        return new self($id, $cliAccessors, BaseArgument::USAGE_SETTING, BaseArgument::USAGE_OPTIONAL, $default);
    }

    /**
     * @param string $id
     * @param string[] $cliAccessors
     * @param $default
     * @return IntArgument
     */
    public static function newOptionalNonSetting(string $id, array $cliAccessors, $default): IntArgument
    {
        return new self($id, $cliAccessors, BaseArgument::USAGE_SETTING, BaseArgument::USAGE_OPTIONAL, $default);
    }
}