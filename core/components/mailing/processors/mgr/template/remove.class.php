<?php

class mailingTemplateRemoveProcessor extends modObjectRemoveProcessor
{
    /** @var string */
    public $classKey = 'mailingTemplate';

    /** @var string */
    public $objectType = 'mailing';

    /** @var array */
    public $languageTopics = [
        'mailing:status',
    ];
}

return 'mailingTemplateRemoveProcessor';
