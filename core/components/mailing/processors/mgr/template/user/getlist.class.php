<?php

require_once MODX_CORE_PATH . 'model/modx/processors/security/user/getlist.class.php';

class mailingTemplateUserGetListProcessor extends modUserGetListProcessor
{
    /** @var string */
    public $objectType = 'mailing';

    /** @var string */
    public $defaultSortField = 'id';

    /** @var mailingTemplate */
    protected $mailingTemplate;

    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        $this->languageTopics[] = 'mailing:status';
        return parent::getLanguageTopics();
    }

    /**
     * @return bool|string|null
     */
    public function initialize()
    {
        $templateId = $this->getProperty('template_id');
        $this->mailingTemplate = $this->modx->getObject('mailingTemplate', [
            'id' => $templateId,
        ]);
        if (!$this->mailingTemplate) {
            return $this->modx->lexicon($this->objectType . '_err_nfs', ['id' => $templateId]);
        }
        $userGroupId = $this->mailingTemplate->get('user_group_id');
        if (!$userGroupId) {
            return $this->modx->lexicon($this->objectType . '_err_ns');
        }
        $this->setDefaultProperties([
            'usergroup' => $userGroupId,
        ]);
        return parent::initialize();
    }

    /**
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $c = parent::prepareQueryBeforeCount($c);
        $c->where([
            $this->classKey . '.active' => 1,
            'Profile.blocked' => 0,
        ]);
        return $c;
    }

    /**
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    public function prepareQueryAfterCount(xPDOQuery $c)
    {
        $c->select($this->classKey . '.id AS user_id');
        return parent::prepareQueryAfterCount($c);
    }
}

return 'mailingTemplateUserGetListProcessor';
