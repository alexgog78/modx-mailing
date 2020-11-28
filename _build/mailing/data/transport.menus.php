<?php

return [
    [
        'text' => 'mailing',
        'description' => 'mailing_desc',
    ],
    [
        'text' => 'mailing_menu_templates',
        'description' => 'mailing_menu_templates_desc',
        'parent' => 'mailing',
        'menuindex' => 0,
        'action' => 'mgr/templates',
    ],
    [
        'text' => 'mailing_menu_queues',
        'description' => 'mailing_menu_queues_desc',
        'parent' => 'mailing',
        'menuindex' => 1,
        'action' => 'mgr/queues',
    ],
    [
        'text' => 'mailing_menu_logs',
        'description' => 'mailing_menu_logs_desc',
        'parent' => 'mailing',
        'menuindex' => 1,
        'action' => 'mgr/logs',
    ],
];
