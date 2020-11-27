<?php

class mailingLogRemoveProcessor extends modObjectRemoveProcessor
{
    /** @var string */
    public $classKey = 'mailingLog';

    /** @var string */
    public $objectType = 'mailing';

    /** @var array */
    public $languageTopics = [
        'mailing:status',
    ];
}

return 'mailingLogRemoveProcessor';
