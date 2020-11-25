<?php

abstract class CLI
{
    /** @var modX */
    protected $modx;

    /** @var Mailing */
    protected $service;

    /**
     * CLI constructor.
     *
     * @param modX $modx
     */
    public function __construct(modX $modx, Mailing $service)
    {
        $this->modx = $modx;
        $this->service = $service;
    }

    abstract public function run();

    /**
     * @param $data
     */
    protected function info($data)
    {
        $this->log($data, modx::LOG_LEVEL_DEBUG);
    }

    /**
     * @param $data
     */
    protected function success($data)
    {
        $this->log($data, modx::LOG_LEVEL_INFO);
    }

    /**
     * @param $data
     */
    protected function error($data)
    {
        $this->log($data, modx::LOG_LEVEL_ERROR);
        exit();
    }

    /**
     * @param $data
     * @param int $level
     */
    private function log($data, $level = modX::LOG_LEVEL_DEBUG)
    {
        if ($data instanceof xPDOObject) {
            $data = $data->toArray('', false, true, true);
        }
        if (is_array($data)) {
            $data = print_r($data, true);
        }
        $this->modx->log($level, $data, '', get_class($this));
    }
}
