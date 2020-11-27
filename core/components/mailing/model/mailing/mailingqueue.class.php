<?php

require_once __DIR__ . '/helpers/timestamps.trait.php';

class mailingQueue extends xPDOSimpleObject
{
    use mailingModelTimestamps;

    const STATUS_SUCCESS = 1;
    const STATUS_ERROR = 2;

    /** @var string|null */
    private $createdOnField = 'created_on';

    /** @var string|null */
    private $createdByField = 'created_by';

    /** @var string|null */
    private $updatedOnField = 'updated_on';

    /** @var string|null */
    private $updatedByField = 'updated_by';

    /**
     * @param null $cacheFlag
     * @return bool
     */
    public function save($cacheFlag = null)
    {
        $this->setTimestamps();
        return parent::save($cacheFlag);
    }

    /**
     * TODO sendEmail
     * @return bool
     */
    public function process()
    {
        $mailingLog = $this->xpdo->newObject('mailingLog');
        $mailingLog->fromArray([
            'template_id' => $this->get('template_id'),
            'user_id' => $this->get('user_id'),
        ]);
        $this->addMany($mailingLog, 'Logs');
        if (!$this->save()) {
            return false;
        }
        return true;
    }
}
