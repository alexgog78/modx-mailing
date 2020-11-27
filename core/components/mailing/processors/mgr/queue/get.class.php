<?php

class mailingQueueGetProcessor extends modObjectGetProcessor
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

return 'mailingQueueGetProcessor';
