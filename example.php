<?php

require_once __DIR__ . '/vendor/autoload.php';

use InstallHelper\Arguments\FlagArgument;
use InstallHelper\Arguments\FloatArgument;
use InstallHelper\Arguments\IntArgument;
use InstallHelper\Arguments\StringArgument;
use InstallHelper\ClParser;
use InstallHelper\Settings;


//parser is collecting the possible Arguments
$parser = new ClParser();
//each Argument extends BaseArgument
$parser->addArgument(StringArgument::newRequiredSetting('name', ['n', 'name']));
//each argument needs an identifier(id) and cli Argument name
$parser->addArgument(FloatArgument::newRequiredSetting('height' , ['h', 'height']));
//as well as further arguments on requirement/optionality and Type which it is casted later on
$parser->addArgument(IntArgument::newOptionalNonSetting('age' , ['a', 'age'], 18));
//optional arguments use the default
$parser->addArgument(new FlagArgument('flag', ['h', 'help']));




$cliHelper = $parser->parse(new Settings(__DIR__ . '/../settings.json'));
$data = $cliHelper->getData();

echo $data->get('int');

$cliHelper->request('float');

$data->getSettings()->save();