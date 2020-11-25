<?php

class MailingTemplateGetListProcessor extends modObjectGetListProcessor
{
    /** @var string */
    public $classKey = 'MailingTemplate';

    /** @var string */
    public $objectType = 'mailing';

    /** @var string */
    public $defaultSortField = 'id';
}

return 'MailingTemplateGetListProcessor';
