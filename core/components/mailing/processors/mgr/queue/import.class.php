<?php

/*if (!$this->loadClass('getlist', MODX_CORE_PATH . 'components/mailing/processors/mgr/template/user/', true, true)) {
    return false;
}*/

class mailingQueueImportProcessor extends modObjectProcessor
//class mailingQueueImportProcessor extends amUserGetListProcessor
{
    /** @var string */
    public $classKey = 'mailingQueue';

    /** @var string */
    public $objectType = 'mailing';

    private $templateId;


    public function initialize()
    {
        $this->templateId = $this->getProperty('id');
        return parent::initialize();
    }

    public function process()
    {
        // TODO: Implement process() method.

        $template = $this->modx->getObject('mailingTemplate', [
            'id' => $this->templateId
        ]);
        if (!$template) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, 'Ошибка в красном цвете!');
        }

        sleep(1);

        $userGroupMembers = $template->getMany('UserGroupMembers');
        foreach ($userGroupMembers as $userGroupMember) {
            //$this->modx->log(modX::LOG_LEVEL_INFO, $userGroupMember->member);

            $user = $userGroupMember->getOne('User');
            $profile = $user->getOne('Profile');


            $object = $this->modx->newObject($this->classKey);
            $object->fromArray([
                'email' => $profile->email,
                'template_id' => $this->templateId
            ]);
            $object->save();

        }
        //$this->modx->log(modX::LOG_LEVEL_INFO, 111);


        return $this->success('');
    }
}

return 'mailingQueueImportProcessor';
