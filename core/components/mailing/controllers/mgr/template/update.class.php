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
        $this->getRecord($scriptProperties);
    }

    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        parent::loadCustomCssJs();
        $this->addJavascript($this->module->config['jsUrl'] . 'mgr/widgets/template/formpanel.js');
        $this->addJavascript($this->module->config['jsUrl'] . 'mgr/widgets/template/users/grid.js');
        $this->addLastJavascript($this->module->config['jsUrl'] . 'mgr/sections/template/update.js');
        $this->loadCodeEditor();

        $configJs = $this->modx->toJSON([
            'xtype' => 'mailing-page-template-update',
            'recordId' => $this->record->id,
            'record' => $this->record->toArray(),
        ]);
        $this->addHtml(
            '<script type="text/javascript">Ext.onReady(function () {MODx.load(' . $configJs . ');});</script>'
        );
    }
}
