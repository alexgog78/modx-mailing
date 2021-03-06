<?php

$xpdo_meta_map['mailingLog'] = [
    'package' => 'mailing',
    'version' => '1.1',
    'table' => 'logs',
    'extends' => 'xPDOSimpleObject',
    'tableMeta' => [
        'engine' => 'InnoDB',
    ],
    'fields' => [
        'queue_id' => NULL,
        'status' => 0,
        'created_on' => NULL,
        'created_by' => 0,
        'properties' => NULL,
    ],
    'fieldMeta' => [
        'queue_id' => [
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
        'created_on' => [
            'dbtype' => 'datetime',
            'phptype' => 'datetime',
            'null' => true,
            'default' => NULL,
        ],
        'created_by' => [
            'dbtype' => 'int',
            'precision' => '10',
            'attributes' => 'unsigned',
            'phptype' => 'integer',
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
        'queue_id' => [
            'alias' => 'queue_id',
            'primary' => false,
            'unique' => false,
            'type' => 'BTREE',
            'columns' => [
                'queue_id' => [
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
        'Queue' => [
            'class' => 'mailingQueue',
            'local' => 'queue_id',
            'foreign' => 'id',
            'cardinality' => 'one',
            'owner' => 'foreign',
        ],
    ],
];
