<?php

define('PKG_NAME', 'Mailing');
define('PKG_NAME_LOWER', 'mailing');

define('MODX_CORE_PATH', dirname(dirname(__DIR__)) . '/core/');
define('MODX_API_MODE', true);

define('DB_TYPE', 'mysql');

define('PKG_PATH', MODX_CORE_PATH . 'components/' . PKG_NAME_LOWER . '/');
define('PKG_MODEL_PATH', MODX_CORE_PATH . 'components/' . PKG_NAME_LOWER . '/model/');
define('PKG_SCHEMA_PATH', MODX_CORE_PATH . 'components/' . PKG_NAME_LOWER . '/model/schema/' . PKG_NAME_LOWER . '.' . DB_TYPE . '.schema.xml');
