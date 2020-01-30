<?php

if (!$this->loadClass('create', MODX_CORE_PATH . 'components/abstractmodule/processors/mgr/object/', true, true)) {
    return false;
}

class mailingQueueCreateProcessor extends amObjectCreateProcessor
{
    /** @var string */
    public $classKey = 'mailingQueue';

    /** @var string */
    public $objectType = 'mailing';
}

return 'mailingQueueCreateProcessor';
