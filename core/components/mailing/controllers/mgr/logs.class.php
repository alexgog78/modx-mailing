<?php

if (!class_exists('MailingManagerController')) {
    require_once __DIR__ . '/manager.class.php';
}

class MailingMgrLogsManagerController extends MailingManagerController
{
    public function loadCustomCssJs()
    {
        parent::loadCustomCssJs();
        $this->addJavascript($this->service->jsUrl . 'mgr/widgets/log/panel.logs.js');
        $this->addJavascript($this->service->jsUrl . 'mgr/widgets/log/grid.log.js');
        $this->addLastJavascript($this->service->jsUrl . 'mgr/sections/log/list.js');
        $this->addHtml('<script type="text/javascript">Ext.onReady(function() { MODx.load({xtype: "mailing-page-log-list"}); });</script>');
    }

    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->getLexiconTopic('logs') . ' | ' . $this->modx->lexicon($this->namespace);
    }
}
