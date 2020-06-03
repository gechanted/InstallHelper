<?php

require_once __DIR__ . '/../vendor/autoload.php';

$parser = new \InstallHelper\ClParser();
$parser->addArgument(\InstallHelper\Arguments\StringArgument::newRequiredSetting('string', ['s', 'string']));
$parser->addArgument(\InstallHelper\Arguments\FloatArgument::newOptionalSetting('float' , ['f', 'float'], 7.3));
$parser->addArgument(\InstallHelper\Arguments\IntArgument::newOptionalNonSetting('int' , ['i', 'int'], 3));
$parser->addArgument(new \InstallHelper\Arguments\FlagArgument('flag', ['h', 'help']));

$cliHelper = $parser->parse(new \InstallHelper\Settings(__DIR__ . '/../settings.json'));
$data = $cliHelper->getData();

echo $data->get('int');

$data->getSettings()->save();


//TODO implement functionality - doctrine setup / composer checker

//TODO add description as a comment in saved format

