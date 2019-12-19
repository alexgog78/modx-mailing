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

    /**
     * @return void
     */
    protected function loadTemplatesCssJs()
    {
        $this->addJavascript($this->module->config['jsUrl'] . 'mgr/widgets/template/grid.js');
        //$this->addJavascript($this->module->config['jsUrl'] . 'mgr/widgets/producttab/producttab.window.js');
    }

    /**
     * @return void
     */
    protected function loadQueuesCssJs()
    {
        $this->addJavascript($this->module->config['jsUrl'] . 'mgr/widgets/queue/grid.js');
        //$this->addJavascript($this->module->config['jsUrl'] . 'mgr/widgets/producttab/producttab.window.js');
    }
}
