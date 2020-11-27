<?php

$mailingTemplates = [];
for ($idx = 1; $idx <= SAMPLEDATA_MAIL_TEMPLATES_COUNT; $idx++) {
    $mailingTemplates[] = [
        'name' => 'MailingTestTemplate (' . $idx . ')',
        'description' => 'mailing_test_mail_template',
        'email_from' => $modx->getOption('emailsender'),
        'email_from_name' => $modx->getOption('site_name'),
        'email_subject' => 'Mailing Test',
        'content' => file_get_contents(MODX_CORE_PATH . 'components/mailing/elements/templates/mail.tpl'),
    ];
}
return $mailingTemplates;
