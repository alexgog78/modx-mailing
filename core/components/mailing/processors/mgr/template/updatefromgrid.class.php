<?php

if (!$this->loadClass('update', MODX_CORE_PATH . 'components/mailing/processors/mgr/template/', true, true)) {
    return false;
}

class mailingTemplateUpdateFromGridProcessor extends mailingTemplateUpdateProcessor
{
    /**
     * @return bool|string|null
     */
    public function initialize()
    {
        $data = $this->getProperty('data');
        if (empty($data)) {
            return $this->modx->lexicon('invalid_data');
        }

        $data = $this->modx->fromJSON($data);
        if (empty($data)) {
            return $this->modx->lexicon('invalid_data');
        }

        $this->setProperties($data);
        $this->unsetProperty('data');

        return parent::initialize();
    }
}

return 'mailingTemplateUpdateFromGridProcessor';
