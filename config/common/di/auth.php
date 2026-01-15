<?php

declare(strict_types=1);

use App\User\IdentityRepository;
use Yiisoft\Auth\AuthenticationMethodInterface;
use Yiisoft\Auth\IdentityRepositoryInterface;
use Yiisoft\Definitions\Reference;
use Yiisoft\Session\SessionInterface;
use Yiisoft\User\CurrentUser;
use Yiisoft\User\Method\WebAuth;

/**
 * Authentication DI Configuration for Yii3
 * 
 * This configures:
 * - IdentityRepositoryInterface -> Our IdentityRepository
 * - CurrentUser with session support
 * - WebAuth as the authentication method
 */
return [
    // Our custom IdentityRepository that fetches users from database
    IdentityRepositoryInterface::class => IdentityRepository::class,
    
    // Configure CurrentUser with session for web auth
    CurrentUser::class => [
        'withSession()' => [Reference::to(SessionInterface::class)],
    ],
    
    // Use WebAuth for session-based web authentication
    AuthenticationMethodInterface::class => WebAuth::class,
];
