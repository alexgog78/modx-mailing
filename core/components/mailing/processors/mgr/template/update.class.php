<?php

if (!$this->loadClass('update', MODX_CORE_PATH . 'components/abstractmodule/processors/mgr/object/', true, true)) {
    return false;
}

class mailingTemplateUpdateProcessor extends amObjectUpdateProcessor
{
    /** @var string */
    public $classKey = 'mailingTemplate';

    /** @var string */
    public $objectType = 'mailing';
}

return 'mailingTemplateUpdateProcessor';
