<?php

require_once __DIR__ . '/manager.class.php';

class mailingMgrLogsManagerController extends mailingManagerController
{
    /** @var array */
    protected $languageTopics = [
        'mailing:log',
        'mailing:user',
    ];

    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->getLexiconTopic('log_list') . parent::getPageTitle();
    }

    public function loadCustomCssJs()
    {
        parent::loadCustomCssJs();
        $this->addJavascript($this->service->jsUrl . 'mgr/widgets/log/panel.logs.js');
        $this->addJavascript($this->service->jsUrl . 'mgr/widgets/log/grid.log.js');
        $this->addJavascript($this->service->jsUrl . 'mgr/widgets/log/window.log.js');
        $this->addLastJavascript($this->service->jsUrl . 'mgr/sections/log/list.js');
        $configJs = $this->modx->toJSON([
            'xtype' => 'mailing-page-log-list',
        ]);
        $this->addHtml('<script type="text/javascript">Ext.onReady(function() { MODx.load(' . $configJs . '); });</script>');
    }
}
