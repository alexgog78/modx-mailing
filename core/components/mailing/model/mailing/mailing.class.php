<?php

class Mailing
{
    const PKG_VERSION = '1.0.0';
    const PKG_RELEASE = 'beta';
    const PKG_NAMESPACE = 'mailing';
    const TABLE_PREFIX = 'mailing_';

    /** @var modX */
    public $modx;

    /** @var array */
    public $config = [];

    /**
     * Mailing constructor.
     *
     * @param modX $modx
     * @param array $config
     */
    public function __construct(modX $modx, array $config = [])
    {
        $this->modx = $modx;
        $this->config = $this->getConfig($config);
        $this->modx->addPackage(self::PKG_NAMESPACE, $this->modelPath, self::TABLE_PREFIX);
        $this->modx->lexicon->load(self::PKG_NAMESPACE . ':default');
    }

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

    /**
     * @param array $config
     * @return array
     */
    protected function getConfig($config = [])
    {
        $corePath = $this->modx->getOption(self::PKG_NAMESPACE . '.core_path', $config, MODX_CORE_PATH . 'components/' . self::PKG_NAMESPACE . '/');
        $assetsPath = $this->modx->getOption(self::PKG_NAMESPACE . '.assets_path', $config, MODX_ASSETS_PATH . 'components/' . self::PKG_NAMESPACE . '/');
        $assetsUrl = $this->modx->getOption(self::PKG_NAMESPACE . '.assets_url', $config, MODX_ASSETS_URL . 'components/' . self::PKG_NAMESPACE . '/');
        return array_merge([
            'corePath' => $corePath,
            'assetsPath' => $assetsPath,
            'modelPath' => $corePath . 'model/',
            'schemaPath' => $corePath . 'model/schema/',
            'helpersPath' => $corePath . 'helpers/',
            'processorsPath' => $corePath . 'processors/',
            'templatesPath' => $corePath . 'elements/templates/',
            'cssPath' => $assetsPath . 'css/',

            'assetsUrl' => $assetsUrl,
            'jsUrl' => $assetsUrl . 'js/',
            'cssUrl' => $assetsUrl . 'css/',
            'connectorUrl' => $assetsUrl . 'connector.php',
            'previewUrl' => $assetsUrl . 'preview.php',
        ], $config);
    }
}
