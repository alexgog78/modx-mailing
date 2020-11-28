<?php

require_once __DIR__ . '/helpers/timestamps.trait.php';

class mailingQueue extends xPDOSimpleObject
{
    use mailingModelTimestamps;

    const STATUS_SUCCESS = 1;
    const STATUS_ERROR = 2;

    /** @var string|null */
    private $createdOnField = 'created_on';

    /** @var string|null */
    private $createdByField = 'created_by';

    /** @var string|null */
    private $updatedOnField = 'updated_on';

    /** @var string|null */
    private $updatedByField = 'updated_by';

    /** @var Mailing */
    private $service;

    /** @var mailingMailer */
    private $mailer;

    /** @var mailingLog */
    private $log;

    /**
     * mailingQueue constructor.
     *
     * @param xPDO $xpdo
     */
    public function __construct(xPDO &$xpdo)
    {
        parent::__construct($xpdo);
        $this->service = $this->xpdo->getService('Mailing', 'Mailing');
        $this->mailer = $this->service->getMailer();
    }

    /**
     * @param null $cacheFlag
     * @return bool
     */
    public function save($cacheFlag = null)
    {
        $this->setTimestamps();
        return parent::save($cacheFlag);
    }

    /**
     * @return bool
     */
    public function process()
    {
        $this->log = $this->addLog();
        $emailStatus = $this->sendEmail();
        $this->addMany($this->log, 'Logs');
        if (!$this->save() || !$emailStatus) {
            return false;
        }
        return true;
    }

    /**
     * @return mailingLog
     */
    private function addLog()
    {
        $log = $this->xpdo->newObject('mailingLog');
        $log->fromArray([
            'template_id' => $this->get('template_id'),
            'user_id' => $this->get('user_id'),
        ]);
        return $log;
    }

    /**
     * @return bool
     */
    private function sendEmail()
    {
        $user = $this->getOne('User');
        $profile = $user->getOne('Profile');
        $template = $this->getOne('Template');

        $config = [
            'emailTo' => $profile->get('email'),
            'emailFrom' => $template->get('email_from') ?? $this->xpdo->getOption('emailsender'),
            'emailFromName' => $template->get('email_from_name') ?? $this->xpdo->getOption('site_name'),
            'emailSubject' => $template->get('email_subject'),
        ];
        $response = $this->service->invokeEvent('OnBeforeEmailSend', $config);
        $config = array_merge($config, $response['returnedValues']);

        $userData = array_merge(
            $user->toArray('', false, true),
            $profile->toArray('', false, true)
        );
        unset($userData['password'], $userData['cachepwd'], $userData['salt'], $userData['remote_key'], $userData['remote_data'], $userData['sessionid']);
        $emailBody = $template->process(['user' => $userData]);

        $this->mailer->set(modMail::MAIL_FROM, $config['emailFrom']);
        $this->mailer->set(modMail::MAIL_FROM_NAME, $config['emailFromName']);
        $this->mailer->set(modMail::MAIL_SENDER, $config['emailFrom']);
        $this->mailer->set(modMail::MAIL_SUBJECT, $config['emailSubject']);
        $this->mailer->address('reply-to', $config['emailFrom']);
        $this->mailer->address('to', $config['emailTo']);
        $this->mailer->set(modMail::MAIL_BODY, $emailBody);
        $this->mailer->setHTML(true);
        if (!$this->mailer->send()) {
            $this->set('status', $this::STATUS_ERROR);
            $this->log->set('status', $this::STATUS_ERROR);
            $this->log->set('properties', [
                'error' => $this->mailer->mailer->ErrorInfo,
            ]);
            $this->mailer->reset();
            return false;
        }
        $this->set('status', $this::STATUS_SUCCESS);
        $this->log->set('status', $this::STATUS_SUCCESS);
        $this->mailer->reset();
        return true;
    }
}
