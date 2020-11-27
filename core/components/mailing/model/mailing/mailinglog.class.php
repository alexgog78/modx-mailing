<?php

require_once __DIR__ . '/helpers/timestamps.trait.php';

class mailingLog extends xPDOSimpleObject
{
    use mailingModelTimestamps;

    /** @var string|null */
    private $createdOnField = 'created_on';

    /** @var string|null */
    private $createdByField = 'created_by';

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
