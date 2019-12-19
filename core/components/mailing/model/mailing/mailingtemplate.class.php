<?php

if (!class_exists('amSimpleObject')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/model/abstractmodule/amsimpleobject.class.php';
}

class mailingTemplate extends amSimpleObject
{
    const BOOLEAN_FIELDS = [];

    const REQUIRED_FIELDS = [
        'name',
    ];

    const UNIQUE_FIELDS = [
        'name',
    ];

    const UNIQUE_FIELDS_CHECK_BY_CONDITIONS = [];
}
