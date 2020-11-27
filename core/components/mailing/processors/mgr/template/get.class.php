<?php

class mailingTemplateGetProcessor extends modObjectGetProcessor
{
    /** @var string */
    public $classKey = 'mailingTemplate';

    /** @var string */
    public $objectType = 'mailing';

    /** @var array */
    public $languageTopics = [
        'mailing:status',
    ];

    public function beforeOutput()
    {
        if (!$this->object->get('content')) {
            $this->object->set('content', '');
        }
        return parent::beforeOutput();
    }
}

return 'mailingTemplateGetProcessor';
