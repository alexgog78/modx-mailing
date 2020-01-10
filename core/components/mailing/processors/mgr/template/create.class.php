<?php

if (!$this->loadClass('create', MODX_CORE_PATH . 'components/abstractmodule/processors/mgr/object/', true, true)) {
    return false;
}

class mailingTemplateCreateProcessor extends amObjectCreateProcessor
{
    /** @var string */
    public $classKey = 'mailingTemplate';

    /** @var string */
    public $objectType = 'mailing';
}

return 'mailingTemplateCreateProcessor';
