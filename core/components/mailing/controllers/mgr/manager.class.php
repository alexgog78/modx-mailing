<?php

abstract class mailingManagerController extends modExtraManagerController
{
    /** @var Mailing */
    protected $service;

    /** @var string */
    protected $assetsVersion;

    /** @var array */
    protected $languageTopics = [];

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        if (isset($this->config[$name])) {
            return $this->config[$name];
        }
        return null;
    }

    public function initialize()
    {
        $this->service = $this->getService($this->namespace, $this->namespace_path);
        $this->assetsVersion = $this->service::PKG_VERSION . '-' . $this->service::PKG_RELEASE;
    }

    /**
     * @return array
     */
    public function getLanguageTopics() {
        return array_merge($this->languageTopics, [
            'mailing:default',
            'mailing:status',
        ]);
    }

    /**
     * @return string
     */
    public function getPageTitle()
    {
        return ' | ' . $this->modx->lexicon($this->namespace);
    }

    public function loadCustomCssJs()
    {
        $this->addCss($this->service->cssUrl . 'mgr/default.css');
        $this->addJavascript($this->service->jsUrl . 'mgr/' . $this->service::PKG_NAMESPACE . '.js');
        $this->addJavascript($this->service->jsUrl . 'mgr/misc/page.js');
        $this->addJavascript($this->service->jsUrl . 'mgr/misc/panel.js');
        $this->addJavascript($this->service->jsUrl . 'mgr/misc/formpanel.js');
        $this->addJavascript($this->service->jsUrl . 'mgr/misc/grid.js');
        $this->addJavascript($this->service->jsUrl . 'mgr/misc/component.list.js');
        $this->addJavascript($this->service->jsUrl . 'mgr/misc/renderer.list.js');
        $this->addJavascript($this->service->jsUrl . 'mgr/combo/select.usergroup.js');
        $configJs = $this->modx->toJSON($this->service->config ?? []);
        $this->addHtml('<script type="text/javascript">' . get_class($this->service) . '.config = ' . $configJs . ';</script>');
    }

    /**
     * @param string $script
     */
    public function addCss($script)
    {
        $script .= '?' . $this->assetsVersion;
        parent::addCss($script);
    }

    /**
     * @param string $script
     */
    public function addJavascript($script)
    {
        $script .= '?' . $this->assetsVersion;
        parent::addJavascript($script);
    }

    /**
     * @param string $script
     */
    public function addLastJavascript($script)
    {
        $script .= '?' . $this->assetsVersion;
        parent::addLastJavascript($script);
    }


    /**
     * @param string $key
     * @param array $placeholders
     * @return string|null
     */
    protected function getLexiconTopic(string $key, $placeholders = [])
    {
        return $this->modx->lexicon($this->namespace . '_' . $key, $placeholders);
    }

    /**
     * @param string $name
     * @param string $path
     * @return object|null
     */
    private function getService(string $name, string $path)
    {
        $service = $this->modx->getService($name, $name, $path . '/model/' . $name . '/');
        return $service;
    }
}
