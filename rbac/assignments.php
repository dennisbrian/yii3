<?php

declare(strict_types=1);

/**
 * RBAC Assignments Configuration
 * 
 * This file stores user-role assignments.
 * Format: userId => ['role1', 'role2']
 * 
 * Will be updated by the user:create-admin command.
 */
return [
    'assignments' => [
        '1' => ['admin'],
        // User assignments will be added here by the CreateAdminCommand
        // Example: '1' => ['admin'],
    ],
];
