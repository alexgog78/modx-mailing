<?php

trait mailingProcessorSearch
{
    /**
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    private function searchQuery(xPDOQuery $c)
    {
        $query = $this->getProperty('query');
        $valuesqry = $this->getProperty('valuesqry');
        $searchableFields = $this->searchableFields;
        if (empty($query) || !empty($valuesqry) || empty($searchableFields)) {
            return $c;
        }
        $filter = [];
        foreach ($this->searchableFields as $field) {
            $filter['OR:' . $field . ':LIKE'] = '%' . $query . '%';
        }
        $c->where([$filter]);
        return $c;
    }
}
