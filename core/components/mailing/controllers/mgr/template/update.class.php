<?php

require_once dirname(__DIR__) . '/manager.class.php';

class mailingMgrTemplateUpdateManagerController extends mailingManagerController
{
    /** @var string */
    protected $objectGetProcessorPath = 'mgr/template/get';

    /** @var string */
    protected $objectPrimaryKey = 'id';

    /** @var array */
    protected $object = [];

    /**
     * @param array $scriptProperties
     */
    public function process(array $scriptProperties = [])
    {
        $this->object = $this->getRecord($scriptProperties);
    }

    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->getLexiconTopic('editing', [
                'record' => $this->getLexiconTopic('template'),
            ]) . parent::getPageTitle();
    }

    public function loadCustomCssJs()
    {
        parent::loadCustomCssJs();
        $this->addJavascript($this->service->jsUrl . 'mgr/widgets/template/formpanel.template.js');
        $this->addJavascript($this->service->jsUrl . 'mgr/widgets/template/grid.user.js');
        $this->addLastJavascript($this->service->jsUrl . 'mgr/sections/template/update.js');
        $configJs = $this->modx->toJSON([
            'xtype' => 'mailing-page-template-update',
            'record' => $this->object,
        ]);
        $this->addHtml('<script type="text/javascript">Ext.onReady(function() { MODx.load(' . $configJs . '); });</script>');
    }

    /**
     * @param array $scriptProperties
     * @return mixed
     */
    private function getRecord($scriptProperties = [])
    {
        $primaryKey = $scriptProperties[$this->objectPrimaryKey];
        $response = $this->modx->runProcessor($this->objectGetProcessorPath, [
            $this->objectPrimaryKey => $primaryKey,
        ], [
            'processors_path' => $this->service->processorsPath ?? '',
        ]);
        if ($response->isError()) {
            $this->failure($response->getMessage());
        }
        return $response->getObject();
    }
}
