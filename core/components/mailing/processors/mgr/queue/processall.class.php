<?php

require_once __DIR__ . '/getlist.class.php';

class mailingQueueProcessAllListProcessor extends mailingQueueGetListProcessor
{
    /** @var array */
    public $languageTopics = [
        'mailing:status',
    ];

    /** @var int */
    private $queuesCount;

    /**
     * @return bool|string|null
     */
    public function initialize()
    {
        $this->queuesCount = intval($this->getProperty('queues_count')) ?? 0;
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
                $this->queuesCount++;
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
        $output['queues_count'] = intval($this->queuesCount);
        if ($output['start'] + $output['limit'] >= $count) {
            $output['finish'] = true;
            $output['message'] = $this->modx->lexicon($this->objectType . '_scs_mailing', [
                'count' => $this->queuesCount,
            ]);
        }
        return $this->modx->toJSON($output);
    }
}

return 'mailingQueueProcessAllListProcessor';
