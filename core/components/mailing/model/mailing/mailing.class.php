<?php

if (!class_exists('abstractModule')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/model/abstractmodule/abstractmodule.class.php';
}

class Mailing extends abstractModule
{
    /** @var string|null */
    protected $tablePrefix = 'mailing_';

    /**
     * @param modManagerController $controller
     * @return bool
     */
    public function addBackendAssets(modManagerController $controller)
    {
        parent::addBackendAssets($controller);
        $controller->addCss($this->config['cssUrl'] . 'mgr/default.css');
        $controller->addJavascript($this->config['jsUrl'] . 'mgr/' . $this->objectType . '.js');
        /*$controller->addJavascript($this->config['jsUrl'] . 'mgr/combo/field.multiselect.js');
        $controller->addJavascript($this->config['jsUrl'] . 'mgr/combo/xtype.multiselect.js');
        $controller->addJavascript($this->config['jsUrl'] . 'mgr/combo/browser.js');
        $controller->addJavascript($this->config['jsUrl'] . 'mgr/util/panel.notice.indevelopment.js');
        $controller->addJavascript($this->config['jsUrl'] . 'mgr/util/panel.notice.undefined.js');*/
        return true;
    }

    /**
     * @return bool
     */
    public function addFrontendAssets()
    {
        return false;
    }
}
