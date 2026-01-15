<?php

declare(strict_types=1);

use Yiisoft\Access\AccessCheckerInterface;
use Yiisoft\Rbac\AssignmentsStorageInterface;
use Yiisoft\Rbac\ItemsStorageInterface;
use Yiisoft\Rbac\Manager;
use Yiisoft\Rbac\ManagerInterface;
use Yiisoft\Rbac\Php\AssignmentsStorage;
use Yiisoft\Rbac\Php\ItemsStorage;

/**
 * RBAC DI Configuration for Yii3
 * 
 * This configures Role-Based Access Control using PHP file storage.
 * Files are stored in /rbac directory:
 * - items.php: roles and permissions
 * - assignments.php: user-role assignments
 */
return [
    // Items storage (roles, permissions)
    ItemsStorageInterface::class => [
        'class' => ItemsStorage::class,
        '__construct()' => [
            'filePath' => dirname(__DIR__, 2) . '/rbac/items.php',
        ],
    ],
    
    // Assignments storage (user -> role mappings)
    AssignmentsStorageInterface::class => [
        'class' => AssignmentsStorage::class,
        '__construct()' => [
            'filePath' => dirname(__DIR__, 2) . '/rbac/assignments.php',
        ],
    ],
    
    // Manager implements both ManagerInterface and AccessCheckerInterface
    ManagerInterface::class => Manager::class,
    AccessCheckerInterface::class => Manager::class,
];
