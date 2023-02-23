<?php
use Laminas\Db\Adapter\AdapterAbstractServiceFactory;

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
    'db' => [
        'driver'         => 'Pdo',
        'dsn'            => 'mysql:dbname=itisde;host=localhost:8889',
        'charset'        => 'utf-8',
        'driver_options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ],
    ],

    'service_manager' => [
        'factories' => [

           'Laminas\Db\Adapter\Adapter' => Laminas\Db\Adapter\AdapterServiceFactory::class,
         ],
      ],
      'static_salt' => 'aFGQ475SDsdfsaf2342', // was moved from module.config.php here to allow all modules to use it
];
