<?php

$xpdo_meta_map['mailingQueue'] = [
    'package' => 'mailing',
    'version' => '1.1',
    'table' => 'queues',
    'extends' => 'xPDOSimpleObject',
    'tableMeta' => [
        'engine' => 'InnoDB',
    ],
    'fields' => [
        'template_id' => NULL,
        'user_id' => NULL,
        'status' => 0,
        'created_on' => NULL,
        'created_by' => 0,
        'updated_on' => NULL,
        'updated_by' => 0,
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
        ],
        'created_by' => [
            'dbtype' => 'int',
            'precision' => '10',
            'attributes' => 'unsigned',
            'phptype' => 'integer',
            'null' => false,
            'default' => 0,
        ],
        'updated_on' => [
            'dbtype' => 'datetime',
            'phptype' => 'datetime',
            'null' => true,
        ],
        'updated_by' => [
            'dbtype' => 'int',
            'precision' => '10',
            'attributes' => 'unsigned',
            'phptype' => 'integer',
            'null' => false,
            'default' => 0,
        ],
    ],
    'indexes' => [
        'queue' => [
            'alias' => 'queue',
            'primary' => false,
            'unique' => true,
            'type' => 'BTREE',
            'columns' => [
                'template_id' => [
                    'length' => '',
                    'collation' => 'A',
                    'null' => false,
                ],
                'user_id' => [
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
    'composites' => [
        'Logs' => [
            'class' => 'mailingLog',
            'local' => 'id',
            'foreign' => 'queue_id',
            'cardinality' => 'many',
            'owner' => 'local',
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
];
