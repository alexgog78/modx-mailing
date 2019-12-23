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

        //$this->template = $this->modx->getObject('mailingTemplate', array('id' => $scriptProperties['id']));
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

        $this->addHtml('<script type="text/javascript">
            // <![CDATA[
            Ext.onReady(function() {
                MODx.load({
                    xtype: "mailing-page-template-update",
                    record:'. $this->modx->toJSON($this->record->toArray()) . '
                });
            });
            // ]]>
           </script>');

        $this->onTempFormPrerender = $this->modx->invokeEvent('OnTempFormPrerender',array(
            'id' => $this->record->get('id'),
            'template' => &$this->record,
            'mode' => modSystemEvent::MODE_UPD,
        ));
        //$this->module->log($this->record);
        /*$this->onTempFormPrerender = $this->modx->invokeEvent('OnTempFormPrerender',array(
            'id' => 0,
            'mode' => modSystemEvent::MODE_NEW,
        ));*/
        //if (is_array($this->onTempFormPrerender)) $this->onTempFormPrerender = implode('',$this->onTempFormPrerender);
        //$this->setPlaceholder('onTempFormPrerender', $this->onTempFormPrerender);
    }
}
