<?php

require_once __DIR__ . '/build.php';
require_once __DIR__ . '/core/sampledata.class.php';

$build = new SampleData($modx, $service);
$build->run();
exit();
