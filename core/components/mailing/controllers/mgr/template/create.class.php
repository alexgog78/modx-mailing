<?php

if (!class_exists('mailingManagerController')) {
    require_once dirname(dirname(__FILE__)) . '/manager.class.php';
}

class mailingMgrTemplateCreateManagerController extends mailingManagerController
{
    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->getLexicon('title.creating', [
            'record' => $this->getLexicon('section.template')
        ]);
    }

    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        parent::loadCustomCssJs();
        $this->addJavascript($this->module->config['jsUrl'] . 'mgr/widgets/template/formpanel.js');
        $this->addLastJavascript($this->module->config['jsUrl'] . 'mgr/sections/template/create.js');
        $this->loadCodeEditor();
    }
}
