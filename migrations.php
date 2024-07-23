<?php

return [
    'table_storage' => [
        'table_name' => 'doctrine_migrations_versions',
        'version_column_name' => 'version',
        'version_column_length' => 512,
        'executed_at_column_name' => 'executed_at',
        'execution_time_column_name' => 'execution_time',
    ],

    'migrations_paths' => [
        'DoctrineMigrations' => 'src/Migrations',
    ],

    'all_or_nothing' => true,
    'transactional' => true,
    'check_database_platform' => true,
    'organize_migrations' => 'none',
    'connection' => 'default',
    'em' => null,
];