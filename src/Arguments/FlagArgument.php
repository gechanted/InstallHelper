<?php
declare(strict_types=1);

namespace InstallHelper\Arguments;

class FlagArgument extends BaseArgument
{

    public function __construct(
        string $id,
        array $cliAccessors = [],
        string $usage = BaseArgument::USAGE_NON_SETTING
    ) {
        parent::__construct($id, $cliAccessors, BaseArgument::TYPE_FLAG, $usage, BaseArgument::USAGE_OPTIONAL, false);
    }
}