<?php

if (!class_exists('amObjectGetListProcessor')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/processors/mgr/object/getlist.class.php';
}

class mailingQueueGetListProcessor extends amObjectGetListProcessor
{
    /** @var string */
    public $classKey = 'mailingQueue';

    /** @var string */
    public $objectType = 'mailing';

    /**
     * @param xPDOQuery $c
     * @param string $query
     * @return xPDOQuery
     */
    public function searchQuery(xPDOQuery $c, $query)
    {
        $c->where([
            'email:LIKE' => '%' . $query . '%',
        ]);
        return $c;
    }
}

return 'mailingQueueGetListProcessor';
