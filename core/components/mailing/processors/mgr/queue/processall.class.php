<?php

require_once __DIR__ . '/getlist.class.php';

class mailingQueueProcessAllListProcessor extends mailingQueueGetListProcessor
{
    /** @var array */
    public $languageTopics = [
        'mailing:status',
    ];

    /** @var int */
    private $successCount;

    /** @var int */
    private $errorCount;

    /**
     * @return bool|string|null
     */
    public function initialize()
    {
        $this->successCount = intval($this->getProperty('success_count')) ?? 0;
        $this->errorCount = intval($this->getProperty('error_count')) ?? 0;
        $rateLimit = intval($this->modx->getOption('mailing_rate_limit'));
        if ($rateLimit) {
            $this->setProperty('limit', $rateLimit);
        }
        return parent::initialize();
    }

    /**
     * @param xPDOObject $object
     * @return array
     */
    public function prepareRow(xPDOObject $object)
    {
        if ($object->get('status') != $this->classKey::STATUS_SUCCESS) {
            if ($object->process()) {
                $this->successCount++;
            } else {
                $this->errorCount++;
            }
        }
        return parent::prepareRow($object);
    }

    /**
     * @param array $array
     * @param false $count
     * @return string
     */
    public function outputArray(array $array, $count = false)
    {
        $output = parent::outputArray($array, $count);
        $output = $this->modx->fromJSON($output);

        $output['start'] = intval($this->getProperty('start'));
        $output['limit'] = intval($this->getProperty('limit'));
        $output['success_count'] = intval($this->successCount);
        $output['error_count'] = intval($this->errorCount);
        if ($output['start'] + $output['limit'] >= $count) {
            $output['finish'] = true;
            $output['message'] = $this->modx->lexicon($this->objectType . '_scs_mailing', [
                'count' => $this->successCount,
                'errors' => $this->errorCount,
            ]);
        }
        return $this->modx->toJSON($output);
    }
}

return 'mailingQueueProcessAllListProcessor';
