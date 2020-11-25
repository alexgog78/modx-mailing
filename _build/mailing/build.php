<?php

require_once __DIR__ . '/build.config.php';

define('MODX_CORE_PATH', dirname(dirname(__DIR__)) . '/core/');
define('MODX_API_MODE', true);
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'model/modx/modx.class.php';

/** modX $modx */
$modx = new modX();
$modx->initialize('mgr');
$modx->setLogLevel(modX::LOG_LEVEL_DEBUG);
$modx->setLogTarget('ECHO');

/** @var Mailing $service */
$service = $modx->getService(PKG_NAME_LOWER, PKG_NAME, MODX_CORE_PATH . 'components/' . PKG_NAME_LOWER . '/model/' . PKG_NAME_LOWER . '/');
