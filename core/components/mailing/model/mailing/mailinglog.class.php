<?php

require_once __DIR__ . '/helpers/timestamps.trait.php';

class mailingLog extends xPDOSimpleObject
{
    use mailingModelTimestamps;

    const STATUS_ERROR = 1;
    const STATUS_SUCCESS = 2;

    /** @var string|null */
    private $createdOnField = 'created_on';

    /**
     * @param null $cacheFlag
     * @return bool
     */
    public function save($cacheFlag = null)
    {
        $this->setTimestamps();
        return parent::save($cacheFlag);
    }
}
