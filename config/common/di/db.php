<?php

declare(strict_types=1);

use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Db\Mysql\Connection;
use Yiisoft\Db\Mysql\Driver;

/**
 * Database configuration for Yii3
 * 
 * This demonstrates the Yii3 approach to database connectivity:
 * - Uses PSR-11 container for dependency injection
 * - No service locator (Yii::$app->db is gone!)
 * - Inject ConnectionInterface where you need database access
 */
return [
    ConnectionInterface::class => [
        'class' => Connection::class,
        '__construct()' => [
            new Driver(
                // DSN format: mysql:host=<host>;dbname=<database>;port=3306
                // Using MySQL container hostname on shared Docker network
                dsn: 'mysql:host=' . ($_ENV['DB_HOST'] ?? 'mysql57') 
                    . ';dbname=' . ($_ENV['DB_NAME'] ?? 'yii3_demo') 
                    . ';port=' . ($_ENV['DB_PORT'] ?? '3306'),
                username: $_ENV['DB_USERNAME'] ?? 'root',
                password: $_ENV['DB_PASSWORD'] ?? 'Root57!',
            ),
        ],
    ],
];
