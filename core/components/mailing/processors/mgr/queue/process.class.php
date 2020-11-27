<?php

require_once __DIR__ . '/get.class.php';

class mailingQueueProcessProcessor extends mailingQueueGetProcessor
{
    /**
     * @return array|mixed|string
     */
    public function process()
    {
        if (!$this->object->process()) {
            return $this->failure($this->modx->lexicon($this->objectType . '_err_save'));
        }
        return parent::process();
    }

    /**
     * @return array|string
     */
    public function cleanup()
    {
        return $this->success($this->modx->lexicon($this->objectType . '_scs_mailing', ['count' => 1]), $this->object->toArray());
    }
}

return 'mailingQueueProcessProcessor';
