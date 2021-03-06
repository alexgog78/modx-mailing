<?php

require_once __DIR__ . '/manager.class.php';

class mailingMgrTemplatesManagerController extends mailingManagerController
{
    /** @var array */
    protected $languageTopics = [
        'mailing:template',
        'mailing:user',
    ];

    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->getLexiconTopic('template_list') . parent::getPageTitle();
    }

    public function loadCustomCssJs()
    {
        parent::loadCustomCssJs();
        $this->addJavascript($this->service->jsUrl . 'mgr/widgets/template/panel.templates.js');
        $this->addJavascript($this->service->jsUrl . 'mgr/widgets/template/grid.template.js');
        $this->addLastJavascript($this->service->jsUrl . 'mgr/sections/template/list.js');
        $configJs = $this->modx->toJSON([
            'xtype' => 'mailing-page-template-list',
        ]);
        $this->addHtml('<script type="text/javascript">Ext.onReady(function() { MODx.load(' . $configJs . '); });</script>');
    }
}
