<?php

if (!class_exists('MailingManagerController')) {
    require_once dirname(__DIR__) . '/manager.class.php';
}

class MailingMgrTemplateCreateManagerController extends MailingManagerController
{
    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->getLexiconTopic('creating', [
                'record' => $this->getLexiconTopic('template'),
            ]) . parent::getPageTitle();
    }

    public function loadCustomCssJs()
    {
        parent::loadCustomCssJs();
        $this->addJavascript($this->service->jsUrl . 'mgr/widgets/template/formpanel.template.js');
        $this->addJavascript($this->service->jsUrl . 'mgr/widgets/template/grid.user.js');
        $this->addLastJavascript($this->service->jsUrl . 'mgr/sections/template/create.js');
        $this->addHtml('<script type="text/javascript">Ext.onReady(function() { MODx.load({xtype: "mailing-page-template-create"}); });</script>');
    }
}
