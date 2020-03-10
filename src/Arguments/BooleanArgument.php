<?php
declare(strict_types=1);

namespace InstallHelper\Arguments;

class BooleanArgument extends BaseArgument
{

    public function __construct(
        string $id,
        array $cliAccessors = [],
        string $usage = BaseArgument::USAGE_SETTING,
        bool $optional = BaseArgument::USAGE_REQUIRED,
        $default = null
    ) {
        parent::__construct($id, $cliAccessors, BaseArgument::TYPE_BOOLEAN, $usage, $optional, $default);
    }


    /**
     * @param string $id
     * @param string[] $cliAccessors
     * @return BooleanArgument
     */
    public static function newRequiredSetting(string $id, array $cliAccessors): BooleanArgument
    {
        return new self($id, $cliAccessors);
    }

    /**
     * @param string $id
     * @param string[] $cliAccessors
     * @param $default
     * @return BooleanArgument
     */
    public static function newOptionalSetting(string $id, array $cliAccessors, $default): BooleanArgument
    {
        return new self($id, $cliAccessors, BaseArgument::USAGE_SETTING, BaseArgument::USAGE_OPTIONAL, $default);
    }

    /**
     * @param string $id
     * @param string[] $cliAccessors
     * @param $default
     * @return BooleanArgument
     */
    public static function newOptionalNonSetting(string $id, array $cliAccessors, $default): BooleanArgument
    {
        return new self($id, $cliAccessors, BaseArgument::USAGE_SETTING, BaseArgument::USAGE_OPTIONAL, $default);
    }

}