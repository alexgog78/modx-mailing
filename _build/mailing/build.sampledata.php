<?php

require_once __DIR__ . '/build.config.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'model/modx/modx.class.php';

/** modX $modx */
$modx = new modX();
$modx->initialize('mgr');
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget('ECHO');
$modx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

/** $service Mailing */
$service = $modx->getService(PKG_NAME_LOWER, PKG_NAME, PKG_MODEL_PATH . PKG_NAME_LOWER . '/');

define('SAMPLEDATA_USERS_COUNT', 100);
define('SAMPLEDATA_USER_GROUPS_COUNT', 1);
define('SAMPLEDATA_MAIL_TEMPLATES_COUNT', 1);

$userGroups = include __DIR__ . '/data/sampledata.usergoups.php';
$mailingTemplates = include __DIR__ . '/data/sampledata.mailingtemplates.php';
$users = include __DIR__ . '/data/sampledata.users.php';


/**
 * Remove old test modUserGroup
 */
$oldUserGroups = $modx->getCollection('modUserGroup', [
    'description' => $userGroups[0]['description'],
]);
foreach ($oldUserGroups as $group) {
    $modx->runProcessor('group/remove', [
        'id' => $group->get('id'),
    ], [
        'processors_path' => MODX_PROCESSORS_PATH . 'security/',
    ]);
}
$query = 'ALTER TABLE ' . $modx->getTableName('modUserGroup') . ' AUTO_INCREMENT = 1;';
$modx->query($query);
$modx->log(modX::LOG_LEVEL_INFO, 'Old test user groups removed');


/**
 * Create test modUserGroup
 */
foreach ($userGroups as $index => $userGroupData) {
    $result = $modx->runProcessor('group/create', $userGroupData, [
        'processors_path' => MODX_PROCESSORS_PATH . 'security/',
    ]);
    $userGroup = $result->getObject();
    $userGroups[$index]['id'] = $userGroup['id'];
    if ($modx->error) {
        $modx->error->reset();
    }
}
$modx->log(modX::LOG_LEVEL_INFO, 'Test user groups created');


/**
 * Remove old test mailingTemplate
 */
$oldMailingTemplates = $modx->getCollection('mailingTemplate', [
    'description' => $mailingTemplates[0]['description'],
]);
foreach ($oldMailingTemplates as $mailingTemplate) {
    $modx->runProcessor('template/remove', [
        'id' => $mailingTemplate->get('id'),
    ], [
        'processors_path' => $service->processorsPath . 'mgr/',
    ]);
}
$query = 'ALTER TABLE ' . $modx->getTableName('mailingTemplate') . ' AUTO_INCREMENT = 1;';
$modx->query($query);
$query = 'ALTER TABLE ' . $modx->getTableName('mailingQueue') . ' AUTO_INCREMENT = 1;';
$modx->query($query);
$query = 'ALTER TABLE ' . $modx->getTableName('mailingLog') . ' AUTO_INCREMENT = 1;';
$modx->query($query);
$modx->log(modX::LOG_LEVEL_INFO, 'Old test mail templates removed');


/**
 * Create test mailingTemplate
 */
foreach ($mailingTemplates as $index => $mailingTemplateData) {
    $userGroupIndex = array_rand($userGroups);
    $mailingTemplateData['user_group_id'] = $userGroups[$userGroupIndex]['id'];

    $result = $modx->runProcessor('template/create', $mailingTemplateData, [
        'processors_path' => $service->processorsPath . 'mgr/',
    ]);
    $mailingTemplate = $result->getObject();
    $mailingTemplates[$index]['id'] = $mailingTemplate['id'];
    if ($modx->error) {
        $modx->error->reset();
    }
}
$modx->log(modX::LOG_LEVEL_INFO, 'Test mail templates created');


/**
 * Remove old test modUser
 */
$oldUsers = $modx->getCollection('modUser', [
    'remote_key' => $users[0]['remote_key'],
]);
foreach ($oldUsers as $user) {
    $modx->runProcessor('user/delete', [
        'id' => $user->get('id'),
    ], [
        'processors_path' => MODX_PROCESSORS_PATH . 'security/',
    ]);
}
$query = 'ALTER TABLE ' . $modx->getTableName('modUser') . ' AUTO_INCREMENT = 1;';
$modx->query($query);
$modx->log(modX::LOG_LEVEL_INFO, 'Old test users removed');


/**
 * Create test modUser
 */
foreach ($users as $index => $userData) {
    $userGroupIndex = array_rand($userGroups);
    $userData['groups'] = $modx->toJSON([
        [
            'usergroup' => $userGroups[$userGroupIndex]['id'],
            'role' => 1,
        ],
    ]);

    $result = $modx->runProcessor('user/create', $userData, [
        'processors_path' => MODX_PROCESSORS_PATH . 'security/',
    ]);
    $user = $result->getObject();
    $users[$index]['id'] = $user['id'];
    if ($modx->error) {
        $modx->error->reset();
    }
}
$modx->log(modX::LOG_LEVEL_INFO, 'Test users created');


exit();
