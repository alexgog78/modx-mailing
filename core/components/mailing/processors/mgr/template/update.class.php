<?php

if (!class_exists('amObjectUpdateProcessor')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/processors/mgr/object/update.class.php';
}

class mailingTemplateUpdateProcessor extends amObjectUpdateProcessor
{
    /** @var string */
    public $classKey = 'mailingTemplate';

    /** @var string */
    public $objectType = 'mailing';
}

return 'mailingTemplateUpdateProcessor';
