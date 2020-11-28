<?php

/** @var modX $modx */

/** @var Mailing $mailing */
$mailing = $modx->getService('mailing', 'Mailing', MODX_CORE_PATH . 'components/mailing/model/mailing/');
if (!($mailing instanceof Mailing)) {
    exit('Could not load Mailing');
}

$modxEvent = $modx->event->name;
switch ($modxEvent) {
    case 'mailingOnBeforeEmailSend':
        /**
         * @var $emailTo
         * @var $emailFrom
         * @var $emailFromName
         * @var $emailSubject
         * @var $emailSubject
         */
        $values = &$modx->Event->returnedValues;
        $values['emailTo'] = $emailTo;
        $values['emailFrom'] = $emailFrom;
        $values['emailFromName'] = $emailFromName;
        $values['emailSubject'] = $emailSubject;
        $modx->event->returnedValues = $values;
        break;
}
return;
