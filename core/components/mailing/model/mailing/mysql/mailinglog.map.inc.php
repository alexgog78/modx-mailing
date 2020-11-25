<?php

$xpdo_meta_map['MailingLog'] = [
    'package' => 'mailing',
    'version' => '1.1',
    'table' => 'logs',
    'extends' => 'xPDOSimpleObject',
    'tableMeta' => [
        'engine' => 'MyISAM',
    ],
    'fields' => [
        'template_id' => NULL,
        'user_id' => NULL,
        'created_on' => NULL,
        'status' => 0,
        'properties' => NULL,
    ],
    'fieldMeta' => [
        'template_id' => [
            'dbtype' => 'int',
            'precision' => '10',
            'attributes' => 'unsigned',
            'phptype' => 'integer',
            'null' => false,
        ],
        'user_id' => [
            'dbtype' => 'int',
            'precision' => '10',
            'attributes' => 'unsigned',
            'phptype' => 'integer',
            'null' => false,
        ],
        'created_on' => [
            'dbtype' => 'datetime',
            'phptype' => 'datetime',
            'null' => true,
            'default' => NULL,
        ],
        'status' => [
            'dbtype' => 'tinyint',
            'precision' => '1',
            'phptype' => 'integer',
            'attributes' => 'unsigned',
            'null' => false,
            'default' => 0,
        ],
        'properties' => [
            'dbtype' => 'text',
            'phptype' => 'json',
            'null' => true,
        ],
    ],
    'indexes' => [
        'user_id' => [
            'alias' => 'user_id',
            'primary' => false,
            'unique' => false,
            'type' => 'BTREE',
            'columns' => [
                'user_id' => [
                    'length' => '',
                    'collation' => 'A',
                    'null' => false,
                ],
            ],
        ],
        'template_id' => [
            'alias' => 'template_id',
            'primary' => false,
            'unique' => false,
            'type' => 'BTREE',
            'columns' => [
                'template_id' => [
                    'length' => '',
                    'collation' => 'A',
                    'null' => false,
                ],
            ],
        ],
        'status' => [
            'alias' => 'status',
            'primary' => false,
            'unique' => false,
            'type' => 'BTREE',
            'columns' => [
                'status' => [
                    'length' => '',
                    'collation' => 'A',
                    'null' => false,
                ],
            ],
        ],
    ],
    'aggregates' => [
        'Template' => [
            'class' => 'mailingTemplate',
            'local' => 'template_id',
            'foreign' => 'id',
            'cardinality' => 'one',
            'owner' => 'foreign',
        ],
        'User' => [
            'class' => 'modUser',
            'local' => 'user_id',
            'foreign' => 'id',
            'cardinality' => 'one',
            'owner' => 'foreign',
        ],
    ],
    'validation' => [
        'rules' => [
            'template_id' => [
                'checkTemplateExistence' => [
                    'type' => 'xPDOValidationRule',
                    'rule' => 'xPDOForeignKeyConstraint',
                    'foreign' => 'id',
                    'local' => 'template_id',
                    'alias' => 'User',
                    'class' => 'modUser',
                    'message' => 'no_records_found',
                ],
            ],
            'user_id' => [
                'checkUserExistence' => [
                    'type' => 'xPDOValidationRule',
                    'rule' => 'xPDOForeignKeyConstraint',
                    'foreign' => 'id',
                    'local' => 'user_id',
                    'alias' => 'Template',
                    'class' => 'mailingTemplate',
                    'message' => 'no_records_found',
                ],
            ],
        ],
    ],
];
