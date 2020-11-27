<?php

$users = [];
for ($idx = 1; $idx <= SAMPLEDATA_USERS_COUNT; $idx++) {
    $users[] = [
        'fullname' => 'MailingTestUser (' . $idx . ')',
        'username' => 'mailing_test_user_' . $idx,
        'email' => 'mailing_test_user_' . $idx . '@' . $modx->getOption('http_host'),
        'remote_key' => 'mailing_test_user',
        'passwordgenmethod' => 'spec',
        'passwordnotifymethod' => 's',
        'specifiedpassword' => '00000000',
        'confirmpassword' => '00000000',
        'active' => 1,
    ];
}
return $users;
