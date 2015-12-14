<?php

require_once __DIR__ . '/MonkeyDataXmlModel.php';
require_once __DIR__ . '/MonkeyDataExampleXmlGenerator.php';


$xmlGenerator = new MonkeyDataExampleXmlGenerator();
$xmlGenerator->run();