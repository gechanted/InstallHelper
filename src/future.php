<?php

require_once __DIR__ . '/../vendor/autoload.php';

$parser = new \InstallHelper\ClParser();
$parser->addArgument(\InstallHelper\Arguments\StringArgument::newRequiredSetting('string', ['s', 'string']));
$parser->addArgument(new \InstallHelper\Arguments\FlagArgument('flag', ['h', 'help']));

$cliHelper = $parser->parse(new \InstallHelper\Settings(__DIR__ . '/../settings.json'));
$data = $cliHelper->getData();
$data->getSettings()->save();


//TODO implement functionality - doctrine setup / composer checker



