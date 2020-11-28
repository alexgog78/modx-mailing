<?php

trait mailingEventHelper
{
    /**
     * @param $eventName
     * @param array $data
     * @return array
     */
    public function invokeEvent($eventName, $data = [])
    {
        $this->modx->event->returnedValues = null;
        $response = [
            'eventOutput' => $this->modx->invokeEvent(Mailing::PKG_NAMESPACE . $eventName, $data),
            'returnedValues' => $this->modx->event->returnedValues ?? [],
        ];
        return $response;
    }
}
