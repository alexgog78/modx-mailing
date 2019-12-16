<?php

if (!class_exists('mailingManagerController')) {
    require_once dirname(__FILE__) . '/manager.class.php';
}

class mailingMgrTemplatesManagerController extends mailingManagerController
{
    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->getLexicon('section.templates');
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
