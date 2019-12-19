<?php

if (!class_exists('amObjectGetListProcessor')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/processors/mgr/object/getlist.class.php';
}

class mailingTemplateGetListProcessor extends amObjectGetListProcessor
{
    /** @var string */
    public $classKey = 'mailingTemplate';

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
            'name:LIKE' => '%' . $query . '%',
            'OR:description:LIKE' => '%' . $query . '%'
        ]);
        return $c;
    }
}

return 'mailingTemplateGetListProcessor';
