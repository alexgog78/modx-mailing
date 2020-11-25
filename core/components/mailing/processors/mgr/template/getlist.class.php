<?php

require_once dirname(__DIR__) . '/helpers/search.trait.php';

class MailingTemplateGetListProcessor extends modObjectGetListProcessor
{
    use MailingProcessorSearch;

    /** @var string */
    public $classKey = 'MailingTemplate';

    /** @var string */
    public $objectType = 'mailing';

    /** @var string */
    public $defaultSortField = 'id';

    /** @var array */
    private $searchableFields = [
        'name',
    ];

    /**
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $c->leftJoin('modUserGroup', 'UserGroup');
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
        $c->select($this->modx->getSelectColumns('modUserGroup', 'UserGroup', 'user_group_', ['name']));
        $c->select([
            'users_count' => '(SELECT COUNT(*) FROM ' . $this->modx->getTableName('modUserGroupMember') . ' WHERE user_group = ' . $this->classKey . '.user_group_id)',
        ]);
        return parent::prepareQueryAfterCount($c);
    }
}

return 'MailingTemplateGetListProcessor';
