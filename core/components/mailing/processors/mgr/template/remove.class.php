<?php

if (!$this->loadClass('remove', MODX_CORE_PATH . 'components/abstractmodule/processors/mgr/object/', true, true)) {
    return false;
}

class mailingTemplateRemoveProcessor extends amObjectRemoveProcessor
{
    /** @var string */
    public $classKey = 'mailingTemplate';

    /** @var string */
    public $objectType = 'mailing';
}

return 'mailingTemplateRemoveProcessor';
