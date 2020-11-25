<?php

/** @noinspection PhpIncludeInspection */
require_once dirname(dirname(dirname(__DIR__))) . '/config.core.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';

/** @var modX $modx */
/** @var Mailing $service */
$service = $modx->getService('mailing', 'Mailing', MODX_CORE_PATH . 'components/mailing/model/mailing/');
$modx->lexicon->load('mailing:default');

/** @var modConnectorRequest $request */
$request = $modx->request;
$processorsPath = $modx->getOption('processorsPath', $service->config, MODX_CORE_PATH . 'processors/');
$request->handleRequest([
    'processors_path' => $processorsPath,
    'location' => '',
]);
