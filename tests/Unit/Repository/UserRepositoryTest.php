<?php

declare(strict_types=1);

namespace App\Tests\Unit\Repository;

use App\Entity\User;
use App\Repository\UserRepository;
use Codeception\Test\Unit;
use PHPUnit\Framework\MockObject\MockObject;
use Yiisoft\Db\Command\CommandInterface;
use Yiisoft\Db\Connection\ConnectionInterface;

use function PHPUnit\Framework\assertSame;

final class UserRepositoryTest extends Unit
{
    private ConnectionInterface|MockObject $db;
    private UserRepository $repository;

    protected function _before(): void
    {
        $this->db = $this->createMock(ConnectionInterface::class);
        $this->repository = new UserRepository($this->db);
    }

    public function testSaveInsertNewUser(): void
    {
        $command = $this->createMock(CommandInterface::class);

        $this->db->expects($this->exactly(2))
            ->method('createCommand')
            ->willReturn($command);

        $user = new User(
            id: null,
            username: 'testuser',
            email: 'test@example.com',
            passwordHash: 'hashedpassword',
            authKey: 'authkey123',
            status: User::STATUS_ACTIVE
        );

        $command->expects($this->once())
            ->method('insert')
            ->with('{{%user}}', [
                'username' => 'testuser',
                'email' => 'test@example.com',
                'password_hash' => 'hashedpassword',
                'auth_key' => 'authkey123',
                'status' => User::STATUS_ACTIVE,
            ])
            ->willReturnSelf();

        $command->expects($this->once())
            ->method('execute');

        $this->db->expects($this->once())
            ->method('getLastInsertID')
            ->willReturn('42');

        $command->method('queryOne')
            ->willReturn([
                'id' => 42,
                'username' => 'testuser',
                'email' => 'test@example.com',
                'password_hash' => 'hashedpassword',
                'auth_key' => 'authkey123',
                'status' => User::STATUS_ACTIVE,
                'created_at' => '2023-01-01 10:00:00',
                'updated_at' => '2023-01-01 10:00:00',
            ]);

        $command->method('withPhpTypecasting')->willReturnSelf();

        // Also mock getQueryBuilder to not crash when Query builds
        $queryBuilder = $this->createMock(\Yiisoft\Db\QueryBuilder\QueryBuilderInterface::class);
        $queryBuilder->method('build')->willReturn(['SELECT * FROM user', []]);
        $this->db->method('getQueryBuilder')->willReturn($queryBuilder);
        $this->db->method('getQuoter')->willReturn($this->createMock(\Yiisoft\Db\Schema\QuoterInterface::class));

        $savedUser = $this->repository->save($user);

        assertSame(42, $savedUser->id);
        assertSame('testuser', $savedUser->username);
        assertSame('test@example.com', $savedUser->email);
    }

    public function testSaveUpdateExistingUser(): void
    {
        $command = $this->createMock(CommandInterface::class);

        $this->db->expects($this->exactly(2))
            ->method('createCommand')
            ->willReturn($command);

        $user = new User(
            id: 42,
            username: 'updateduser',
            email: 'updated@example.com',
            passwordHash: 'newhashedpassword',
            authKey: 'authkey123',
            status: User::STATUS_INACTIVE,
            createdAt: new \DateTimeImmutable('2023-01-01 10:00:00'),
            updatedAt: new \DateTimeImmutable('2023-01-01 10:00:00')
        );

        $command->expects($this->once())
            ->method('update')
            ->with('{{%user}}', [
                'username' => 'updateduser',
                'email' => 'updated@example.com',
                'password_hash' => 'newhashedpassword',
                'status' => User::STATUS_INACTIVE,
            ], ['id' => 42])
            ->willReturnSelf();

        $command->expects($this->once())
            ->method('execute');

        $this->db->expects($this->never())
            ->method('getLastInsertID');

        $command->method('queryOne')
            ->willReturn([
                'id' => 42,
                'username' => 'updateduser',
                'email' => 'updated@example.com',
                'password_hash' => 'newhashedpassword',
                'auth_key' => 'authkey123',
                'status' => User::STATUS_INACTIVE,
                'created_at' => '2023-01-01 10:00:00',
                'updated_at' => '2023-01-02 10:00:00',
            ]);

        $command->method('withPhpTypecasting')->willReturnSelf();

        $queryBuilder = $this->createMock(\Yiisoft\Db\QueryBuilder\QueryBuilderInterface::class);
        $queryBuilder->method('build')->willReturn(['SELECT * FROM user', []]);
        $this->db->method('getQueryBuilder')->willReturn($queryBuilder);
        $this->db->method('getQuoter')->willReturn($this->createMock(\Yiisoft\Db\Schema\QuoterInterface::class));

        $savedUser = $this->repository->save($user);

        assertSame(42, $savedUser->id);
        assertSame('updateduser', $savedUser->username);
        assertSame('updated@example.com', $savedUser->email);
        assertSame(User::STATUS_INACTIVE, $savedUser->status);
    }
}
