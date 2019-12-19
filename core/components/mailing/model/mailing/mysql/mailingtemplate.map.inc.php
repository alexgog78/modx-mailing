<?php

$xpdo_meta_map['mailingTemplate'] = [
    'package' => 'mailing',
    'version' => '1.0',
    'table' => 'templates',
    'extends' => 'xPDOSimpleObject',
    'tableMeta' => [
        'engine' => 'MyISAM',
    ],
    'fields' => [
        'name' => NULL,
        'description' => NULL,
        'user_group_id' => 0,
        'subject' => NULL,
        'template' => NULL,
    ],
    'fieldMeta' => [
        'name' => [
            'dbtype' => 'varchar',
            'precision' => '255',
            'phptype' => 'string',
            'null' => true,
        ],
        'description' => [
            'dbtype' => 'text',
            'phptype' => 'string',
            'null' => true,
        ],
        'user_group_id' => [
            'dbtype' => 'int',
            'precision' => '10',
            'attributes' => 'unsigned',
            'phptype' => 'integer',
            'null' => false,
            'default' => 0,
        ],
        'subject' => [
            'dbtype' => 'varchar',
            'precision' => '255',
            'phptype' => 'string',
            'null' => true,
        ],
        'template' => [
            'dbtype' => 'text',
            'phptype' => 'string',
            'null' => true,
        ],
    ],
    'indexes' => [
        'user_group_id' => [
            'alias' => 'user_group_id',
            'primary' => false,
            'unique' => false,
            'type' => 'BTREE',
            'columns' => [
                'user_group_id' => [
                    'length' => '',
                    'collation' => 'A',
                    'null' => false,
                ],
            ],
        ],
    ],
    'composites' => [
        'Queues' => [
            'class' => 'mailingQueue',
            'local' => 'id',
            'foreign' => 'template_id',
            'cardinality' => 'many',
            'owner' => 'local',
        ],
    ],
    'aggregates' => [
        'UserGroup' => [
            'class' => 'modUserGroup',
            'local' => 'user_group_id',
            'foreign' => 'id',
            'cardinality' => 'one',
            'owner' => 'foreign',
        ],
        'UserGroupMembers' => [
            'class' => 'modUserGroupMember',
            'local' => 'user_group_id',
            'foreign' => 'user_group',
            'cardinality' => 'many',
            'owner' => 'local',
        ],
    ],
];
