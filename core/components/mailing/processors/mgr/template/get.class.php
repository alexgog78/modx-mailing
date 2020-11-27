<?php

class mailingTemplateGetProcessor extends modObjectGetProcessor
{
    /** @var string */
    public $classKey = 'mailingTemplate';

    /** @var string */
    public $objectType = 'mailing';

    public function beforeOutput()
    {
        if (!$this->object->get('content')) {
            $this->object->set('content', '');
        }
        return parent::beforeOutput();
    }
}

return 'mailingTemplateGetProcessor';
