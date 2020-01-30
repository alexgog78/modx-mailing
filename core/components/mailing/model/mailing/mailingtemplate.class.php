<?php

if (!$this->loadClass('amsimpleobject', MODX_CORE_PATH . 'components/abstractmodule/model/abstractmodule/', true, true)) {
    return false;
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
