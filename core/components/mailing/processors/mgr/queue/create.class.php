<?php

if (!class_exists('amObjectCreateProcessor')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/processors/mgr/object/create.class.php';
}

class mailingQueueCreateProcessor extends amObjectCreateProcessor
{
    /** @var string */
    public $classKey = 'mailingQueue';

    /** @var string */
    public $objectType = 'mailing';
}

return 'mailingQueueCreateProcessor';
