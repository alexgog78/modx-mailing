<?php

require_once __DIR__ . '/cli.class.php';

class BuildModel extends CLI
{
    /** @var xPDOManager */
    private $manager;

    /** @var xPDOGenerator */
    private $generator;

    /**
     * BuildModel constructor.
     *
     * @param modX $modx
     * @param string $namespace
     */
    public function __construct(modX $modx, Mailing $service)
    {
        parent::__construct($modx, $service);
        $this->manager = $this->modx->getManager();
        $this->generator = $this->manager->getGenerator();
    }

    public function run()
    {
        $this->createModelFiles();
        $this->createDatabaseTables();
    }

    private function createModelFiles()
    {
        $schemaPath = $this->getSchemaPath();
        $modelPath = $this->getModelPath();
        $status = $this->generator->parseSchema($schemaPath, $modelPath);
        if (!$status) {
            $this->error('Error generating model');
        }
        $this->success('Model generated');
    }

    /**
     * @return string
     */
    private function getSchemaPath()
    {
        return $this->service->schemaPath . $this->service::PKG_NAMESPACE . '.' . $this->modx->config['dbtype'] . '.schema.xml';
    }

    /**
     * @return string
     */
    private function getModelPath()
    {
        return $this->service->modelPath;
    }

    private function createDatabaseTables()
    {
        $metaMap = $this->getMetaMap();
        foreach ($metaMap as $baseClass => $extends) {
            if (!in_array($baseClass, ['xPDOObject', 'xPDOSimpleObject'])) {
                continue;
            }
            foreach ($extends as $className) {
                if (!$this->manager->createObjectContainer($className)) {
                    $this->error('Error creating DB tables');
                }
            }
        }
        $this->success('DB tables generated');
    }

    /**
     * @return array
     */
    private function getMetaMap()
    {
        $mapFile = $this->service->modelPath . $this->service::PKG_NAMESPACE . '/metadata.' . $this->modx->config['dbtype'] . '.php';
        if (!file_exists($mapFile)) {
            $this->error('No DB tables metadata file: ' . $mapFile);
        }
        include $mapFile;
        if (empty($xpdo_meta_map)) {
            $this->error('$xpdo_meta_map empty');
        }
        return $xpdo_meta_map;
    }
}
