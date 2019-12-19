<?php
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

$corePath = $modx->getOption(
    'mailing.core_path',
    null,
    $modx->getOption('core_path') . 'components/mailing/'
);
require_once $corePath . 'model/mailing/mailing.class.php';
$modx->mailing = new Mailing($modx);
$modx->lexicon->load('mailing:default');

$path = $modx->getOption('processorsPath', $modx->mailing->config, $corePath . 'processors/');
$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location' => ''
));
