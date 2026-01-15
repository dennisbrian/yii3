<?php

declare(strict_types=1);

namespace App\User;

use Yiisoft\Auth\IdentityInterface;

/**
 * User Identity for Yii3 Authentication
 * 
 * This class represents an authenticated user identity.
 * Unlike Yii2 where User model and Identity were often combined,
 * Yii3 separates these concerns cleanly.
 */
final readonly class Identity implements IdentityInterface
{
    public function __construct(
        private string $id,
        private string $username,
        private string $email,
        private string $passwordHash,
        private int $status = 10,
    ) {}
    
    public function getId(): string
    {
        return $this->id;
    }
    
    public function getUsername(): string
    {
        return $this->username;
    }
    
    public function getEmail(): string
    {
        return $this->email;
    }
    
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }
    
    public function getStatus(): int
    {
        return $this->status;
    }
    
    /**
     * Verify password against hash
     */
    public function validatePassword(string $password): bool
    {
        return password_verify($password, $this->passwordHash);
    }
}
