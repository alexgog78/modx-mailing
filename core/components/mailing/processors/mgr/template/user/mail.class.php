<?php

require_once __DIR__ . '/getlist.class.php';

//TODO remove
require_once dirname(dirname(dirname((dirname((__DIR__)))))) . '/helpers/log.trait.php';

class mailingTemplateUserMailProcessor extends mailingTemplateUserGetListProcessor
{
    use mailingLogHelper;

    /**@var modPHPMailer */
    private $mail;

    /** @var mailingLog */
    protected $mailingLog;

    /** @var int */
    private $emailsCount = 0;

    /** @var int */
    private $errorsCount = 0;

    /**
     * @return bool|string|null
     */
    public function initialize()
    {
        $this->mail = $this->modx->getService('mail', 'mail.modPHPMailer');
        return parent::initialize();
    }

    /**
     * @return array|mixed|string
     */
    public function process()
    {
        $result = parent::process();
        if ($this->errorsCount) {
            return $this->failure($this->modx->lexicon($this->objectType . '_err_mailing'));
        }
        return $result;
    }

    /**
     * @param xPDOObject $object
     * @return array
     */
    public function prepareRow(xPDOObject $object)
    {
        $this->saveLog($object);
        $emailTo = $object->get('email');
        $emailFrom = $this->mailingTemplate->get('email_from') ?? $this->modx->getOption('emailsender');
        $emailFromName = $this->mailingTemplate->get('email_from_name') ?? $this->modx->getOption('site_name');
        $emailSubject = $this->mailingTemplate->get('email_subject');
        $emailBody = $this->mailingTemplate->process(['user' => $object->toArray('', false, true)]);
        $this->sendEmail($emailTo, $emailFrom, $emailFromName, $emailSubject, $emailBody);
        return parent::prepareRow($object);
    }

    /**
     * @param array $array
     * @param false $count
     * @return string
     */
    public function outputArray(array $array, $count = false)
    {
        $output = parent::outputArray($array, $count);
        $output = $this->modx->fromJSON($output);
        $output['message'] = $this->modx->lexicon($this->objectType . '_scs_mailing');
        return $this->modx->toJSON($output);
    }

    /**
     * @param xPDOObject $object
     */
    private function saveLog(xPDOObject $object)
    {
        $this->mailingLog = $this->modx->newObject('mailingLog');
        $this->mailingLog->fromArray([
            'template_id' => $this->mailingTemplate->get('id'),
            'user_id' => $object->get('id'),
            'status' => 0,
        ]);
        if (!$this->mailingLog->save()) {
            $this->errorsCount++;
        }
    }

    /**
     * @param string $to
     * @param string $from
     * @param string $fromName
     * @param string $subject
     * @param string $body
     */
    private function sendEmail(string $to, string $from, string $fromName, $subject = '', $body = '')
    {
        $this->mail->set(modMail::MAIL_BODY, $body);
        $this->mail->set(modMail::MAIL_FROM, $from);
        $this->mail->set(modMail::MAIL_FROM_NAME, $fromName);
        $this->mail->set(modMail::MAIL_SENDER, $from);
        $this->mail->set(modMail::MAIL_SUBJECT, $subject);
        $this->mail->address('reply-to', $from);
        $this->mail->address('to', $to);
        $this->mail->setHTML(true);
        if (!$this->mail->send()) {
            $this->errorsCount++;
            $this->mailingLog->set('status', $this->mailingLog::STATUS_ERROR);
            $this->mailingLog->set('properties', [
                'error' => $this->mail->mailer->ErrorInfo,
            ]);
        } else {
            $this->mailingLog->set('status', $this->mailingLog::STATUS_SUCCESS);
        }
        if (!$this->mailingLog->save()) {
            $this->errorsCount++;
        }
        $this->mail->reset();
    }
}

return 'mailingTemplateUserMailProcessor';
