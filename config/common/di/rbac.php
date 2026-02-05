<?php

declare(strict_types=1);

use Yiisoft\Access\AccessCheckerInterface;
use Yiisoft\Rbac\AssignmentsStorageInterface;
use Yiisoft\Rbac\ItemsStorageInterface;
use Yiisoft\Rbac\Manager;
use Yiisoft\Rbac\ManagerInterface;
use Yiisoft\Rbac\Db\AssignmentsStorage;
use Yiisoft\Rbac\Php\ItemsStorage;

/**
 * RBAC DI Configuration for Yii3
 * 
 * This configures Role-Based Access Control using Hybrid storage:
 * - Roles/Permissions (Items): PHP file (static, read-heavy)
 * - Assignments: Database (dynamic, write-heavy)
 */
return [
    // Items storage (roles, permissions) - File based
    ItemsStorageInterface::class => [
        'class' => ItemsStorage::class,
        '__construct()' => [
            'filePath' => dirname(__DIR__, 2) . '/rbac/items.php',
        ],
    ],
    
    // Assignments storage (user -> role mappings) - Database based
    AssignmentsStorageInterface::class => AssignmentsStorage::class,
    
    // Manager implements both ManagerInterface and AccessCheckerInterface
    ManagerInterface::class => Manager::class,
    AccessCheckerInterface::class => Manager::class,
];
