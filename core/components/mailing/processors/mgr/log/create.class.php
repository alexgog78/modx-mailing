<?php

class MailingLogCreateProcessor extends modObjectCreateProcessor
{
    /** @var string */
    public $classKey = 'MailingLog';

    /** @var string */
    public $objectType = 'mailing';

    /** @var array */
    public $languageTopics = [
        'mailing:status',
    ];
}

return 'MailingLogCreateProcessor';
