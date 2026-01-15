<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Db\Query\Query;

/**
 * User Repository in Yii3
 * 
 * This is the Yii3 way to access data:
 * - Repository pattern abstracts database access
 * - Uses Dependency Injection (constructor injection)
 * - No Yii::$app->db - inject ConnectionInterface instead
 * - Returns domain entities, not ActiveRecord models
 * - Keeps SQL/Query logic out of controllers
 */
final readonly class UserRepository
{
    public function __construct(
        private ConnectionInterface $db,
    ) {}
    
    /**
     * Find user by ID
     */
    public function findById(int $id): ?User
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
     * Find user by email
     */
    public function findByEmail(string $email): ?User
    {
        $row = (new Query($this->db))
            ->from('{{%user}}')
            ->where(['email' => $email])
            ->one();
            
        if ($row === false) {
            return null;
        }
        
        return $this->hydrate($row);
    }
    
    /**
     * Get all active users
     */
    public function findAllActive(): array
    {
        $rows = (new Query($this->db))
            ->from('{{%user}}')
            ->where(['status' => User::STATUS_ACTIVE])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
            
        return array_map(fn($row) => $this->hydrate($row), $rows);
    }
    
    /**
     * Save user to database
     */
    public function save(User $user): User
    {
        $command = $this->db->createCommand();
        
        if ($user->id === null) {
            // Insert new user
            $command->insert('{{%user}}', [
                'username' => $user->username,
                'email' => $user->email,
                'password_hash' => $user->passwordHash,
                'auth_key' => $user->authKey,
                'status' => $user->status,
            ])->execute();
            
            $id = (int) $this->db->getLastInsertID();
            return $this->findById($id);
        }
        
        // Update existing user
        $command->update('{{%user}}', [
            'username' => $user->username,
            'email' => $user->email,
            'password_hash' => $user->passwordHash,
            'status' => $user->status,
        ], ['id' => $user->id])->execute();
        
        return $this->findById($user->id);
    }
    
    /**
     * Hydrate array to User entity
     */
    private function hydrate(array $row): User
    {
        return new User(
            id: (int) $row['id'],
            username: $row['username'],
            email: $row['email'],
            passwordHash: $row['password_hash'],
            authKey: $row['auth_key'],
            status: (int) $row['status'],
            createdAt: new \DateTimeImmutable($row['created_at']),
            updatedAt: new \DateTimeImmutable($row['updated_at']),
        );
    }
}
