<?php

require_once dirname(__DIR__) . '/helpers/search.trait.php';

class MailingLogGetListProcessor extends modObjectGetListProcessor
{
    use MailingProcessorSearch;

    /** @var string */
    public $classKey = 'MailingLog';

    /** @var string */
    public $objectType = 'mailing';

    /** @var string */
    public $defaultSortField = 'id';

    /** @var array */
    private $searchableFields = [
        'Template.name',
        'Profile.email',
    ];

    /**
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $c->leftJoin('MailingTemplate', 'Template');
        $c->leftJoin('modUser', 'User');
        $c->leftJoin('modUserProfile', 'Profile', 'User.id = Profile.internalKey');
        $this->searchQuery($c);
        return parent::prepareQueryBeforeCount($c);
    }

    /**
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    public function prepareQueryAfterCount(xPDOQuery $c)
    {
        $c->select($this->modx->getSelectColumns($this->classKey, $this->classKey));
        $c->select($this->modx->getSelectColumns('MailingTemplate', 'Template', 'template_', ['name']));
        $c->select($this->modx->getSelectColumns('modUser', 'User', 'user_', ['password', 'cachepwd', 'salt',], true));
        $c->select($this->modx->getSelectColumns('modUserProfile', 'Profile', 'user_', ['fullname', 'email', 'blocked',]));
        return parent::prepareQueryAfterCount($c);
    }
}

return 'MailingLogGetListProcessor';
