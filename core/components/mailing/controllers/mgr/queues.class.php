<?php

if (!class_exists('mailingManagerController')) {
    require_once dirname(__FILE__) . '/manager.class.php';
}

class mailingMgrQueuesManagerController extends mailingManagerController
{
    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->getLexicon('section.queues');
    }

    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        parent::loadCustomCssJs();
        //$this->loadProductTabsCssJs();
        //$this->addLastJavascript($this->module->config['jsUrl'] . 'mgr/sections/producttab/producttabs.panel.js');
    }
}
