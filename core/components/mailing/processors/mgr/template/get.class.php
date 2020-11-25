<?php

class MailingTemplateGetProcessor extends modObjectGetProcessor
{
    /** @var string */
    public $classKey = 'MailingTemplate';

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

return 'MailingTemplateGetProcessor';
