<?php

require_once dirname(__FILE__) . '/config.inc.php';

if (!class_exists('amBuildSchema')) {
    require_once MODX_BASE_PATH . '_build/abstractmodule/build.schema.php';
}

class buildSchema extends amBuildSchema
{
}

echo '<pre>';
$buildSchema = new buildSchema($modx);
$buildSchema->process();
echo '</pre>';

exit();
