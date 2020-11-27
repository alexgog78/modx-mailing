<?php

require_once __DIR__ . '/remove.class.php';

class mailingLogRemoveMultipleProcessor extends mailingLogRemoveProcessor
{
    /** @var string */
    public $classKey = 'mailingLog';

    /** @var string */
    public $objectType = 'mailing';

    /** @var array */
    public $languageTopics = [
        'mailing:status',
    ];

    /**
     * @return bool|string|null
     */
    public function initialize() {
        return true;
    }

    /**
     * @return array|mixed|string
     */
    public function process()
    {
        $collection = $this->modx->getCollection($this->classKey);
        foreach ($collection as $log) {
            $this->object = $log;
            parent::process();
        }
        return $this->success('');
    }
}

return 'mailingLogRemoveMultipleProcessor';
