<?php

class MailingLogGetListProcessor extends modObjectGetListProcessor
{
    /** @var string */
    public $classKey = 'MailingLog';

    /** @var string */
    public $objectType = 'mailing';

    /** @var string */
    public $defaultSortField = 'id';
}

return 'MailingLogGetListProcessor';
