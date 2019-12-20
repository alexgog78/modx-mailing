<?php

if (!class_exists('amManagerController')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/controllers/mgr/manager.class.php';
}

abstract class mailingManagerController extends amManagerController
{
    /**
     * @var array
     */
    protected $languageTopics = ['mailing:default'];

    /**
     * @return void
     */
    protected function getService()
    {
        $this->module = $this->modx->getService(
            'mailing',
            'Mailing',
            $this->modx->getOption('core_path') . 'components/mailing/model/mailing/',
            []
        );
    }
}
