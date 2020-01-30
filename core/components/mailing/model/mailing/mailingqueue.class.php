<?php

if (!$this->loadClass('amsimpleobject', MODX_CORE_PATH . 'components/abstractmodule/model/abstractmodule/', true, true)) {
    return false;
}

class mailingQueue extends amSimpleObject
{
    const BOOLEAN_FIELDS = [];

    const REQUIRED_FIELDS = [
        'email',
        'template_id',
    ];

    const UNIQUE_FIELDS = [];

    const UNIQUE_FIELDS_CHECK_BY_CONDITIONS = [];
}

