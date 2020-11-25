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
$modx->lexicon->load('mailing:default', 'mailing:status');

/** @var MailingTemplate $template */
$template = $modx->getObject('MailingTemplate', [
    'id' => $_REQUEST['template'],
]);
if (!$template) {
    die($modx->lexicon('mailing_err_nfs', ['id' => $_REQUEST['template']]));
}

$user = $modx->user;
$profile = $user->getOne('Profile');

$html = $template->process(['user' => array_merge($user->toArray(), $profile->toArray())]);
die($html);
