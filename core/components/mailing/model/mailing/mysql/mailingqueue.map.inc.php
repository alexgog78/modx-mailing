<?php

$xpdo_meta_map['mailingQueue'] = [
    'package' => 'mailing',
    'version' => '1.0',
    'table' => 'queues',
    'extends' => 'xPDOSimpleObject',
    'tableMeta' => [
        'engine' => 'MyISAM',
    ],
    'fields' => [
        'email' => NULL,
        'template_id' => NULL,
        'is_processed' => 0,
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
        'is_processed' => [
            'dbtype' => 'tinyint',
            'precision' => '1',
            'attributes' => 'unsigned',
            'phptype' => 'boolean',
            'null' => false,
            'default' => 0,
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
        'is_processed' => [
            'alias' => 'is_processed',
            'primary' => false,
            'unique' => false,
            'type' => 'BTREE',
            'columns' => [
                'is_processed' => [
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
