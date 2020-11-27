<?php

require_once dirname(__DIR__) . '/helpers/search.trait.php';

class mailingLogGetListProcessor extends modObjectGetListProcessor
{
    use mailingProcessorSearch;

    /** @var string */
    public $classKey = 'mailingLog';

    /** @var string */
    public $objectType = 'mailing';

    /** @var string */
    public $defaultSortField = 'created_on';

    /** @var string */
    public $defaultSortDirection = 'DESC';

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
        $c->leftJoin('mailingQueue', 'Queue');
        $c->leftJoin('mailingTemplate', 'Template', 'Template.id = Queue.template_id');
        $c->leftJoin('modUser', 'User', 'User.id = Queue.user_id');
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
        $c->select($this->modx->getSelectColumns('mailingTemplate', 'Template', 'template_', ['id', 'name']));
        $c->select($this->modx->getSelectColumns('modUser', 'User', 'user_', ['password', 'cachepwd', 'salt',], true));
        $c->select($this->modx->getSelectColumns('modUserProfile', 'Profile', 'user_', ['fullname', 'email', 'blocked',]));
        return parent::prepareQueryAfterCount($c);
    }
}

return 'mailingLogGetListProcessor';
