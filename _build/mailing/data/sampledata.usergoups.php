<?php

$userGroups = [];
for ($idx = 1; $idx <= SAMPLEDATA_USER_GROUPS_COUNT; $idx++) {
    $userGroups[] = [
        'name' => 'MailingTestGroup (' . $idx . ')',
        'description' => 'mailing_test_group',
    ];
}
return $userGroups;
