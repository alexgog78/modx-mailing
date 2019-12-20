<?php

if (!class_exists('mailingManagerController')) {
    require_once dirname(dirname(__FILE__)) . '/manager.class.php';
}

class mailingMgrTemplateUpdateManagerController extends mailingManagerController
{
    /** @var string */
    protected $recordClassKey = 'mailingTemplate';

    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->getLexicon('title.editing', [
            'record' => $this->getLexicon('section.template')
        ]);
    }

    /**
     * @param array $scriptProperties
     * @return mixed
     */
    public function process(array $scriptProperties = []) {
        $this->checkForRecord($scriptProperties);
    }

    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        parent::loadCustomCssJs();
        $this->addJavascript($this->module->config['jsUrl'] . 'mgr/widgets/template/formpanel.js');
        $this->addJavascript($this->module->config['jsUrl'] . 'mgr/widgets/template/form.js');
        $this->addLastJavascript($this->module->config['jsUrl'] . 'mgr/sections/template/update.js');
    }
}
