<?php

if (!class_exists('abstractModule')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/model/abstractmodule/abstractmodule.class.php';
}

class Mailing extends abstractModule
{
    /** @var string|null */
    protected $tablePrefix = 'mailing_';

    /** @var array */
    public $handlers = [
        'mgr' => [
            'template' => 'mailingTemplateHandler',
            'email' => 'mailingEmailHandler',
        ],
        'default' => [],
    ];

    public function __construct(modX &$modx, array $config = [])
    {
        parent::__construct($modx, $config);
        $this->config['previewUrl'] = $this->config['assetsUrl'] . 'preview.php';
    }

    /**
     * @param modManagerController $controller
     * @return bool
     */
    public function addBackendAssets(modManagerController $controller)
    {
        parent::addBackendAssets($controller);
        $controller->addCss($this->config['cssUrl'] . 'mgr/default.css');
        $controller->addJavascript($this->config['jsUrl'] . 'mgr/' . $this->objectType . '.js');
        $controller->addJavascript($this->config['jsUrl'] . 'mgr/utils/notice.indevelopment.js');
        $controller->addJavascript($this->config['jsUrl'] . 'mgr/utils/notice.undefined.js');
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
