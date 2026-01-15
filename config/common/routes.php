<?php

declare(strict_types=1);

use App\Web;
use Yiisoft\Auth\Middleware\Authentication;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;

return [
    Group::create()
        ->routes(
            // Public routes
            Route::get('/')
                ->action(Web\HomePage\Action::class)
                ->name('home'),
                
            // Auth routes
            Route::methods(['GET', 'POST'], '/login')
                ->action(Web\Auth\LoginAction::class)
                ->name('login'),
                
            Route::get('/logout')
                ->action(Web\Auth\LogoutAction::class)
                ->name('logout'),
                
            // Protected routes (require authentication)
            Route::get('/dashboard')
                ->middleware(Authentication::class)
                ->action(Web\Dashboard\DashboardAction::class)
                ->name('dashboard'),
        ),
];
