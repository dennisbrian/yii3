<?php

declare(strict_types=1);

namespace App\Entity;

/**
 * User Entity (Domain Model) in Yii3
 * 
 * Key differences from Yii2 ActiveRecord:
 * - Plain PHP class, NOT extending ActiveRecord
 * - Uses PHP 8 readonly properties and constructor promotion
 * - Immutable by design (Yii3 emphasizes immutability)
 * - No database coupling - that's the Repository's job
 * - Can use Data Transfer Objects (DTOs) for forms
 */
final readonly class User
{
    public function __construct(
        public ?int $id = null,
        public string $username = '',
        public string $email = '',
        public string $passwordHash = '',
        public string $authKey = '',
        public int $status = 10,
        public ?\DateTimeImmutable $createdAt = null,
        public ?\DateTimeImmutable $updatedAt = null,
    ) {}
    
    public const STATUS_DELETED = 0;
    public const STATUS_INACTIVE = 9;
    public const STATUS_ACTIVE = 10;
    
    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }
    
    /**
     * Create a new User with modified properties (immutable pattern)
     */
    public function withEmail(string $email): self
    {
        return new self(
            id: $this->id,
            username: $this->username,
            email: $email,
            passwordHash: $this->passwordHash,
            authKey: $this->authKey,
            status: $this->status,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
        );
    }
}
