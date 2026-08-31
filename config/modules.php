<?php

return [
    'namespace' => 'Modules',

    'stubs' => [
        'enabled' => false,
    ],

    'paths' => [
        'modules' => base_path('Modules'),

        'generator' => [
            'config' => ['path' => 'config', 'generate' => true],
            'command' => ['path' => 'app/Console', 'generate' => true],
            'migration' => ['path' => 'database/migrations', 'generate' => true],
            'seeder' => ['path' => 'database/seeders', 'generate' => true],
            'factory' => ['path' => 'database/factories', 'generate' => true],
            'model' => ['path' => 'app/Models', 'generate' => true],
            'routes' => ['path' => 'routes', 'generate' => true],
            'controller' => ['path' => 'app/Http/Controllers', 'generate' => true],
            'views' => ['path' => 'resources/views', 'generate' => true],
            'provider' => ['path' => 'app/Providers', 'generate' => true],
        ],

        'assets' => public_path('modules'),
        'migration' => base_path('database/migrations'),
    ],

    'commands' => [],

    'scan' => [
        'enabled' => false,
    ],

    'composer' => [
        'vendor' => 'polindra',
        'author' => [
            'name' => 'SIKI Polindra',
            'email' => '',
        ],
    ],

    'cache' => [
        'enabled' => false,
        'key' => 'laravel-modules',
        'lifetime' => 60,
    ],

    'register' => [
        'translations' => true,
    ],

    'activators' => [
        'file' => [
            'class' => \Nwidart\Modules\Activators\FileActivator::class,
            'statuses-file' => base_path('modules_statuses.json'),
        ],
    ],

    'activator' => 'file',
];
