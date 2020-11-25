<?php

if (!$this->loadClass('getlist', MODX_CORE_PATH . 'components/abstractmodule/processors/mgr/user/', true, true)) {
    return false;
}

class MailingTemplateUserGetListProcessor extends amUserGetListProcessor
{
    /**
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $c = parent::prepareQueryBeforeCount($c);

        $this->filterActive($c);

        $userGroupId = $this->getProperty('user_group_id');
        if ($userGroupId) {
            $this->filterUserGroup($c, $userGroupId);
        }
        return $c;
    }

    /**
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    private function filterActive(xPDOQuery $c)
    {
        $c->where([
            $this->classKey . '.active' => 1,
            'Profile.blocked' => 0,
        ]);
        return $c;
    }

    /**
     * @param xPDOQuery $c
     * @param int $userGroupId
     * @return xPDOQuery
     */
    private function filterUserGroup(xPDOQuery $c, $userGroupId = 0)
    {
        $c->innerJoin('modUserGroupMember', 'UserGroupMembers');
        $c->where([
            'UserGroupMembers.user_group' => $userGroupId,
        ]);
        return $c;
    }
}

return 'MailingTemplateUserGetListProcessor';
