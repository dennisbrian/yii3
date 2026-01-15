<?php

declare(strict_types=1);

/**
 * RBAC Items Configuration
 * 
 * This file defines roles and permissions for the application.
 * Format required by yiisoft/rbac-php package.
 */
return [
    'items' => [
        // Permissions
        'viewDashboard' => [
            'type' => 'permission',
            'description' => 'Can view admin dashboard',
        ],
        'manageUsers' => [
            'type' => 'permission',
            'description' => 'Can manage users',
        ],
        'viewContent' => [
            'type' => 'permission',
            'description' => 'Can view protected content',
        ],
        
        // Roles
        'user' => [
            'type' => 'role',
            'description' => 'Regular user',
            'children' => [
                'viewContent',
            ],
        ],
        'admin' => [
            'type' => 'role', 
            'description' => 'Administrator with full access',
            'children' => [
                'user',           // Inherits all user permissions
                'viewDashboard',
                'manageUsers',
            ],
        ],
    ],
];
