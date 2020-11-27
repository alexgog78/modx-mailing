<?php

require_once __DIR__ . '/remove.class.php';

class mailingQueueRemoveMultipleProcessor extends mailingQueueRemoveProcessor
{
    /** @var bool */
    private $onlySuccess = false;

    /**
     * @return bool|string|null
     */
    public function initialize() {
        $this->onlySuccess = $this->getProperty('only_success', false);
        return true;
    }

    /**
     * @return array|mixed|string
     */
    public function process()
    {
        $c = $this->modx->newQuery($this->classKey);
        $this->prepareQuery($c);
        $collection = $this->modx->getCollection($this->classKey, $c);
        foreach ($collection as $log) {
            $this->object = $log;
            parent::process();
        }
        return $this->success('');
    }

    /**
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    private function prepareQuery(xPDOQuery $c)
    {
        if ($this->onlySuccess) {
            $c->where([
                $this->classKey . '.status' => $this->classKey::STATUS_SUCCESS,
            ]);
        }
        return $c;
    }
}

return 'mailingQueueRemoveMultipleProcessor';
