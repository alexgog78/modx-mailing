<?php

if (!class_exists('amObjectUpdateProcessor')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/processors/mgr/object/update.class.php';
}

class mailingQueueUpdateProcessor extends amObjectUpdateProcessor
{
    /** @var string */
    public $classKey = 'mailingQueue';

    /** @var string */
    public $objectType = 'mailing';
}

return 'mailingQueueUpdateProcessor';
