<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use Codeception\Test\Unit;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertTrue;

final class UserTest extends Unit
{
    public function testConstruct(): void
    {
        $user = new User();

        assertSame(null, $user->id);
        assertSame('', $user->username);
        assertSame('', $user->email);
        assertSame('', $user->passwordHash);
        assertSame('', $user->authKey);
        assertSame(10, $user->status);
        assertSame(null, $user->createdAt);
        assertSame(null, $user->updatedAt);

        $now = new \DateTimeImmutable();

        $userWithArgs = new User(
            id: 1,
            username: 'testuser',
            email: 'test@example.com',
            passwordHash: 'hash',
            authKey: 'auth_key',
            status: User::STATUS_INACTIVE,
            createdAt: $now,
            updatedAt: $now
        );

        assertSame(1, $userWithArgs->id);
        assertSame('testuser', $userWithArgs->username);
        assertSame('test@example.com', $userWithArgs->email);
        assertSame('hash', $userWithArgs->passwordHash);
        assertSame('auth_key', $userWithArgs->authKey);
        assertSame(User::STATUS_INACTIVE, $userWithArgs->status);
        assertSame($now, $userWithArgs->createdAt);
        assertSame($now, $userWithArgs->updatedAt);
    }

    public function testIsActive(): void
    {
        $activeUser = new User(status: User::STATUS_ACTIVE);
        assertTrue($activeUser->isActive());

        $inactiveUser = new User(status: User::STATUS_INACTIVE);
        assertFalse($inactiveUser->isActive());

        $deletedUser = new User(status: User::STATUS_DELETED);
        assertFalse($deletedUser->isActive());
    }

    public function testWithEmail(): void
    {
        $now = new \DateTimeImmutable();
        $user = new User(
            id: 1,
            username: 'testuser',
            email: 'old@example.com',
            passwordHash: 'hash',
            authKey: 'auth_key',
            status: User::STATUS_ACTIVE,
            createdAt: $now,
            updatedAt: $now
        );

        $newEmail = 'new@example.com';
        $updatedUser = $user->withEmail($newEmail);

        // Ensure a new instance is returned
        $this->assertNotSame($user, $updatedUser);

        // Verify the new email is set
        assertSame($newEmail, $updatedUser->email);

        // Verify other properties remain unchanged
        assertSame($user->id, $updatedUser->id);
        assertSame($user->username, $updatedUser->username);
        assertSame($user->passwordHash, $updatedUser->passwordHash);
        assertSame($user->authKey, $updatedUser->authKey);
        assertSame($user->status, $updatedUser->status);
        assertSame($user->createdAt, $updatedUser->createdAt);
        assertSame($user->updatedAt, $updatedUser->updatedAt);

        // Verify the old user remains unchanged
        assertSame('old@example.com', $user->email);
    }
}
