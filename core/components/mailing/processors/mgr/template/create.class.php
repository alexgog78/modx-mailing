<?php

class MailingTemplateCreateProcessor extends modObjectCreateProcessor
{

    /** @var string */
    public $classKey = 'MailingTemplate';

    /** @var string */
    public $objectType = 'mailing';

    /** @var array */
    public $languageTopics = [
        'mailing:status',
    ];
}

return 'MailingTemplateCreateProcessor';
