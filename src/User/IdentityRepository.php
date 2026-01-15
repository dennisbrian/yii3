<?php

declare(strict_types=1);

namespace App\User;

use Yiisoft\Auth\IdentityInterface;
use Yiisoft\Auth\IdentityRepositoryInterface;
use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Db\Query\Query;

/**
 * Identity Repository for Yii3 Authentication
 * 
 * This repository finds user identities from the database.
 * It implements IdentityRepositoryInterface required by CurrentUser service.
 */
final readonly class IdentityRepository implements IdentityRepositoryInterface
{
    public function __construct(
        private ConnectionInterface $db,
    ) {}
    
    /**
     * Find identity by user ID (used for session-based auth)
     */
    public function findIdentity(string $id): ?IdentityInterface
    {
        $row = (new Query($this->db))
            ->from('{{%user}}')
            ->where(['id' => $id])
            ->one();
            
        if ($row === false) {
            return null;
        }
        
        return $this->hydrate($row);
    }
    
    /**
     * Find identity by access token (used for API auth)
     */
    public function findIdentityByToken(string $token, string $type = null): ?IdentityInterface
    {
        $row = (new Query($this->db))
            ->from('{{%user}}')
            ->where(['auth_key' => $token])
            ->one();
            
        if ($row === false) {
            return null;
        }
        
        return $this->hydrate($row);
    }
    
    /**
     * Find identity by email (for login)
     */
    public function findByEmail(string $email): ?Identity
    {
        $row = (new Query($this->db))
            ->from('{{%user}}')
            ->where(['email' => $email])
            ->one();
            
        if ($row === false || $row === null) {
            return null;
        }
        
        return $this->hydrate($row);
    }
    
    /**
     * Create new user in database
     */
    public function create(string $username, string $email, string $password): Identity
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $authKey = bin2hex(random_bytes(16));
        
        $this->db->createCommand()->insert('{{%user}}', [
            'username' => $username,
            'email' => $email,
            'password_hash' => $passwordHash,
            'auth_key' => $authKey,
            'status' => 10,
        ])->execute();
        
        $id = $this->db->getLastInsertID();
        
        return new Identity(
            id: (string) $id,
            username: $username,
            email: $email,
            passwordHash: $passwordHash,
            status: 10,
        );
    }
    
    /**
     * Hydrate database row to Identity object
     */
    private function hydrate(array $row): Identity
    {
        return new Identity(
            id: (string) $row['id'],
            username: $row['username'],
            email: $row['email'],
            passwordHash: $row['password_hash'],
            status: (int) $row['status'],
        );
    }
}
