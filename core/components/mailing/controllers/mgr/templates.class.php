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
        $this->addJavascript($this->module->config['jsUrl'] . 'mgr/widgets/template/grid.js');
        $this->addLastJavascript($this->module->config['jsUrl'] . 'mgr/sections/template/list.js');
    }
}
