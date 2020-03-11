<?php
declare(strict_types=1);

namespace InstallHelper\Arguments;

class StringArgument extends BaseArgument
{


    public function __construct(
        string $id,
        array $cliAccessors = [],
        string $usage = BaseArgument::USAGE_SETTING,
        bool $optional = BaseArgument::USAGE_REQUIRED,
        $default = null
    ) {
        parent::__construct($id, $cliAccessors, BaseArgument::TYPE_STRING, $usage, $optional, $default);
    }


    /**
     * @param string $id
     * @param string[] $cliAccessors
     * @return StringArgument
     */
    public static function newRequiredSetting(string $id, array $cliAccessors): StringArgument
    {
        return new self($id, $cliAccessors);
    }

    /**
     * @param string $id
     * @param string[] $cliAccessors
     * @return StringArgument
     */
    public static function newRequiredNonSetting(string $id, array $cliAccessors): StringArgument
    {
        return new self($id, $cliAccessors, BaseArgument::USAGE_NON_SETTING);
    }

    /**
     * @param string $id
     * @param string[] $cliAccessors
     * @param $default
     * @return StringArgument
     */
    public static function newOptionalSetting(string $id, array $cliAccessors, $default): StringArgument
    {
        return new self($id, $cliAccessors, BaseArgument::USAGE_SETTING, BaseArgument::USAGE_OPTIONAL, $default);
    }

    /**
     * @param string $id
     * @param string[] $cliAccessors
     * @param $default
     * @return StringArgument
     */
    public static function newOptionalNonSetting(string $id, array $cliAccessors, $default): StringArgument
    {
        return new self($id, $cliAccessors, BaseArgument::USAGE_NON_SETTING, BaseArgument::USAGE_OPTIONAL, $default);
    }


}