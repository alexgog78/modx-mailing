<?php

if (!class_exists('amObjectRemoveProcessor')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/processors/mgr/object/remove.class.php';
}

class mailingTemplateRemoveProcessor extends amObjectRemoveProcessor
{
    /** @var string */
    public $classKey = 'mailingTemplate';

    /** @var string */
    public $objectType = 'mailing';
}

return 'mailingTemplateRemoveProcessor';
