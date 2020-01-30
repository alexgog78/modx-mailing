<?php

$xpdo_meta_map['mailingQueue'] = [
    'package' => 'mailing',
    'version' => '1.1',
    'table' => 'queues',
    'extends' => 'xPDOSimpleObject',
    'tableMeta' => [
        'engine' => 'MyISAM',
    ],
    'fields' => [
        'email' => NULL,
        'template_id' => NULL,
        'status' => 0,
        'status_properties' => NULL,
    ],
    'fieldMeta' => [
        'email' => [
            'dbtype' => 'varchar',
            'precision' => '255',
            'phptype' => 'string',
            'null' => true,
        ],
        'template_id' => [
            'dbtype' => 'int',
            'precision' => '10',
            'attributes' => 'unsigned',
            'phptype' => 'integer',
            'null' => false,
        ],
        'status' => [
            'dbtype' => 'tinyint',
            'precision' => '1',
            'phptype' => 'integer',
            'attributes' => 'unsigned',
            'null' => false,
            'default' => 0,
        ],
        'status_properties' => [
            'dbtype' => 'text',
            'phptype' => 'json',
            'null' => true,
        ],
    ],
    'indexes' => [
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
    ],
];
