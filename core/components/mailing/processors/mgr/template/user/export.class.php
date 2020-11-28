<?php

require_once __DIR__ . '/getlist.class.php';

class mailingTemplateUserExportProcessor extends mailingTemplateUserGetListProcessor
{
    /** @var int */
    private $userCount;

    /**
     * @return bool|string|null
     */
    public function initialize()
    {
        $this->userCount = intval($this->getProperty('user_count')) ?? 0;
        return parent::initialize();
    }

    /**
     * @param xPDOObject $object
     * @return array
     */
    public function prepareRow(xPDOObject $object)
    {
        $queueData = [
            'template_id' => $this->getProperty('template_id'),
            'user_id' => $object->get('id'),
        ];

        $c = $this->modx->newQuery('mailingQueue', $queueData);
        $count = $this->modx->getCount('mailingQueue', $c);
        if ($count) {
            return parent::prepareRow($object);
        }

        $queue = $this->modx->newObject('mailingQueue');
        $queue->fromArray($queueData);
        if ($queue->save()) {
            $this->userCount++;
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
        $output['user_count'] = intval($this->userCount);
        if ($output['start'] + $output['limit'] >= $count) {
            $output['finish'] = true;
            $output['message'] = $this->modx->lexicon($this->objectType . '_scs_queue', [
                'count' => $this->userCount,
            ]);
        }
        return $this->modx->toJSON($output);
    }
}

return 'mailingTemplateUserExportProcessor';
