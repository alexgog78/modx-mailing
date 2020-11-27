<?php

require_once __DIR__ . '/build.config.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'model/modx/modx.class.php';

/** modX $modx */
$modx = new modX();
$modx->initialize('mgr');
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget('ECHO');

/** @var xPDOManager $manager */
$manager = $modx->getManager();
/** @var xPDOGenerator $generator */
$generator = $modx->manager->getGenerator();


/**
 * Generate model files
 */
$status = $generator->parseSchema(PKG_SCHEMA_PATH, PKG_MODEL_PATH);
if (!$status) {
    $modx->log(modX::LOG_LEVEL_ERROR, 'Error generating model');
    exit();
}


/**
 * Create DB tables
 */
$service = $modx->getService(PKG_NAME_LOWER, PKG_NAME, PKG_MODEL_PATH . PKG_NAME_LOWER . '/');
$mapFile = $service->modelPath . $service::PKG_NAMESPACE . '/metadata.' . DB_TYPE . '.php';
include $mapFile;
foreach ($xpdo_meta_map as $baseClass => $extends) {
    foreach ($extends as $className) {
        $manager->createObjectContainer($className);
    }
}


exit();
