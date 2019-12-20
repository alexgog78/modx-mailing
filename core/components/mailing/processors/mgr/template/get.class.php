<?php

if (!class_exists('amObjectGetProcessor')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/processors/mgr/object/get.class.php';
}

class mailingTemplateGetProcessor extends amObjectGetProcessor
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
    /*public function searchQuery(xPDOQuery $c, $query)
    {
        $c->where([
            'name:LIKE' => '%' . $query . '%',
            'OR:description:LIKE' => '%' . $query . '%'
        ]);
        return $c;
    }*/
}

return 'mailingTemplateGetProcessor';
