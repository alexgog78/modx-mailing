<?php

class mailingQueueRemoveProcessor extends modObjectRemoveProcessor
{
    /** @var string */
    public $classKey = 'mailingQueue';

    /** @var string */
    public $objectType = 'mailing';

    /** @var array */
    public $languageTopics = [
        'mailing:status',
    ];
}

return 'mailingQueueRemoveProcessor';
