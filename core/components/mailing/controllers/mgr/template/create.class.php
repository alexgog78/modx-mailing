<?php

require_once dirname(__DIR__) . '/manager.class.php';

class mailingMgrTemplateCreateManagerController extends mailingManagerController
{
    /** @var string */
    protected $objectClassKey = 'mailingTemplate';

    /** @var mailingTemplate */
    private $objectFactory;

    /**
     * @param array $scriptProperties
     */
    public function process(array $scriptProperties = [])
    {
        $this->objectFactory = $this->modx->newObject($this->objectClassKey);
    }

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
        $configJs = $this->modx->toJSON([
            'xtype' => 'mailing-page-template-create',
            'defaultValues' => [
                'content' => $this->objectFactory->getEmailDefaultTemplate(),
            ],
        ]);
        $this->addHtml('<script type="text/javascript">Ext.onReady(function() { MODx.load(' . $configJs . '); });</script>');
    }
}
