<?php

require_once __DIR__ . '/build.php';
require_once __DIR__ . '/core/buildmodel.class.php';

$build = new BuildModel($modx, $service);
$build->run();
exit();
