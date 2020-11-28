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

/** $builder modPackageBuilder */
$builder = $modx->loadClass('transport.modPackageBuilder', '', false, true);
$builder = new modPackageBuilder($modx);

/** $service Mailing */
$service = $modx->getService(PKG_NAME_LOWER, PKG_NAME, PKG_MODEL_PATH . PKG_NAME_LOWER . '/');


/**
 * Creating package
 */
$builder->createPackage(PKG_NAME_LOWER, $service::PKG_VERSION, $service::PKG_RELEASE);
$builder->registerNamespace(PKG_NAME_LOWER, false, true, '{core_path}components/' . PKG_NAME_LOWER . '/', '{assets_path}components/' . PKG_NAME_LOWER . '/');
$builder->setPackageAttributes([
    'changelog' => file_get_contents(PKG_PATH . 'docs/changelog.txt'),
    'license' => file_get_contents(PKG_PATH . 'docs/license.txt'),
    'readme' => file_get_contents(PKG_PATH . 'docs/readme.txt'),
]);


/**
 * CORE files
 */
$vehicle = $builder->createVehicle([
    'source' => MODX_CORE_PATH . 'components/' . PKG_NAME_LOWER,
    'target' => "return MODX_CORE_PATH . 'components/';",
], [
    'vehicle_class' => 'xPDOFileVehicle',
]);
$builder->putVehicle($vehicle);


/**
 * ASSETS files
 */
$vehicle = $builder->createVehicle([
    'source' => MODX_ASSETS_PATH . 'components/' . PKG_NAME_LOWER,
    'target' => "return MODX_ASSETS_PATH . 'components/';",
], [
    'vehicle_class' => 'xPDOFileVehicle',
]);
$builder->putVehicle($vehicle);


/**
 * modMenu
 */
$menus = include __DIR__ . '/data/transport.menus.php';
foreach ($menus as $menuData) {
    $menu = $modx->newObject('modMenu');
    $menu->fromArray(array_merge([
        'parent' => 'components',
        'namespace' => PKG_NAME_LOWER,
    ], $menuData), '', true, true);
    $vehicle = $builder->createVehicle($menu, [
        xPDOTransport::PRESERVE_KEYS => true,
        xPDOTransport::UPDATE_OBJECT => true,
        xPDOTransport::UNIQUE_KEY => 'text',
    ]);
    $builder->putVehicle($vehicle);
}


/**
 * modEvent
 */
$events = include __DIR__ . '/data/transport.events.php';
foreach ($events as $eventData) {
    $event = $modx->newObject('modEvent');
    $event->fromArray(array_merge([
        'service' => 6,
        'groupname' => PKG_NAME,
    ], $eventData), '', true, true);
    $vehicle = $builder->createVehicle($event, [
        xPDOTransport::PRESERVE_KEYS => true,
        xPDOTransport::UPDATE_OBJECT => true,
        xPDOTransport::UNIQUE_KEY => 'name',
    ]);
    $builder->putVehicle($vehicle);
}


/**
 * modSystemSetting
 */
$settings = include __DIR__ . '/data/transport.settings.php';
foreach ($settings as $settingData) {
    $setting = $modx->newObject('modSystemSetting');
    $setting->fromArray(array_merge([
        'namespace' => PKG_NAME_LOWER,
    ], $settingData), '', true, true);
    $vehicle = $builder->createVehicle($setting, [
        xPDOTransport::PRESERVE_KEYS => true,
        xPDOTransport::UPDATE_OBJECT => false,
        xPDOTransport::UNIQUE_KEY => 'key',
    ]);
    $builder->putVehicle($vehicle);
}


/**
 * DB Tables
 */
$tables = __DIR__ . '/resolvers/resolve.tables.php';
$vehicle = $builder->createVehicle([
    'source' => $tables,
], [
    'vehicle_class' => 'xPDOScriptVehicle',
]);
$builder->putVehicle($vehicle);


/**
 * Create .zip file
 */
$builder->pack();
exit();
