<?php

declare(strict_types=1);

namespace App\Tests\Unit\User;

use App\User\Identity;
use App\User\IdentityRepository;
use Codeception\Test\Unit;
use Yiisoft\Db\Command\CommandInterface;
use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Db\QueryBuilder\QueryBuilderInterface;

final class IdentityRepositoryTest extends Unit
{
    private ConnectionInterface $dbMock;
    private QueryBuilderInterface $queryBuilderMock;
    private CommandInterface $commandMock;

    protected function _before(): void
    {
        $this->dbMock = $this->createMock(ConnectionInterface::class);
        $this->queryBuilderMock = $this->createMock(QueryBuilderInterface::class);
        $this->commandMock = $this->createMock(CommandInterface::class);

        $this->dbMock->method('getQueryBuilder')->willReturn($this->queryBuilderMock);
        $this->dbMock->method('createCommand')->willReturn($this->commandMock);

        $this->queryBuilderMock->method('build')->willReturn(['SELECT *', []]);
        $this->commandMock->method('withPhpTypecasting')->willReturn($this->commandMock);
    }

    public function testFindIdentitySuccess(): void
    {
        $userData = [
            'id' => 1,
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password_hash' => 'hash',
            'status' => 10,
        ];

        $this->commandMock->expects($this->once())
            ->method('queryOne')
            ->willReturn($userData);

        $repository = new IdentityRepository($this->dbMock);
        $identity = $repository->findIdentity('1');

        $this->assertNotNull($identity);
        $this->assertInstanceOf(Identity::class, $identity);
        $this->assertEquals('1', $identity->getId());
        $this->assertEquals('testuser', $identity->getUsername());
        $this->assertEquals('test@example.com', $identity->getEmail());
        $this->assertEquals('hash', $identity->getPasswordHash());
        $this->assertEquals(10, $identity->getStatus());
    }

    public function testFindIdentityNotFound(): void
    {
        $this->commandMock->expects($this->once())
            ->method('queryOne')
            ->willReturn(null);

        $repository = new IdentityRepository($this->dbMock);
        $identity = $repository->findIdentity('999');

        $this->assertNull($identity);
    }

    public function testFindIdentityByTokenSuccess(): void
    {
        $userData = [
            'id' => 2,
            'username' => 'tokenuser',
            'email' => 'token@example.com',
            'password_hash' => 'hash2',
            'status' => 10,
        ];

        $this->commandMock->expects($this->once())
            ->method('queryOne')
            ->willReturn($userData);

        $repository = new IdentityRepository($this->dbMock);
        $identity = $repository->findIdentityByToken('valid-token');

        $this->assertNotNull($identity);
        $this->assertEquals('2', $identity->getId());
        $this->assertEquals('tokenuser', $identity->getUsername());
    }

    public function testFindIdentityByTokenNotFound(): void
    {
        $this->commandMock->expects($this->once())
            ->method('queryOne')
            ->willReturn(null);

        $repository = new IdentityRepository($this->dbMock);
        $identity = $repository->findIdentityByToken('invalid-token');

        $this->assertNull($identity);
    }

    public function testFindByEmailSuccess(): void
    {
        $userData = [
            'id' => 3,
            'username' => 'emailuser',
            'email' => 'email@example.com',
            'password_hash' => 'hash3',
            'status' => 10,
        ];

        $this->commandMock->expects($this->once())
            ->method('queryOne')
            ->willReturn($userData);

        $repository = new IdentityRepository($this->dbMock);
        $identity = $repository->findByEmail('email@example.com');

        $this->assertNotNull($identity);
        $this->assertEquals('3', $identity->getId());
        $this->assertEquals('emailuser', $identity->getUsername());
    }

    public function testFindByEmailNotFound(): void
    {
        $this->commandMock->expects($this->once())
            ->method('queryOne')
            ->willReturn(null);

        $repository = new IdentityRepository($this->dbMock);
        $identity = $repository->findByEmail('notfound@example.com');

        $this->assertNull($identity);
    }

    public function testCreate(): void
    {
        // For create(), createCommand() is called twice (once for insert, once for getLastInsertID).
        // Wait, IdentityRepository::create() calls $this->db->createCommand()->insert(...)->execute() directly
        // and then $this->db->getLastInsertID().
        // Let's reset the mock setup for dbMock inside this specific test.
        $dbMock = $this->createMock(ConnectionInterface::class);
        $commandMock = $this->createMock(CommandInterface::class);

        $dbMock->expects($this->once())
            ->method('createCommand')
            ->willReturn($commandMock);

        $commandMock->expects($this->once())
            ->method('insert')
            ->with(
                $this->equalTo('{{%user}}'),
                $this->callback(function ($columns) {
                    return isset($columns['username']) && $columns['username'] === 'newuser'
                        && isset($columns['email']) && $columns['email'] === 'newuser@example.com'
                        && isset($columns['password_hash']) && password_verify('secret123', $columns['password_hash'])
                        && isset($columns['auth_key']) && strlen($columns['auth_key']) === 32
                        && isset($columns['status']) && $columns['status'] === 10;
                })
            )
            ->willReturn($commandMock);

        $commandMock->expects($this->once())
            ->method('execute')
            ->willReturn(1);

        $dbMock->expects($this->once())
            ->method('getLastInsertID')
            ->willReturn('4');

        $repository = new IdentityRepository($dbMock);
        $identity = $repository->create('newuser', 'newuser@example.com', 'secret123');

        $this->assertNotNull($identity);
        $this->assertInstanceOf(Identity::class, $identity);
        $this->assertEquals('4', $identity->getId());
        $this->assertEquals('newuser', $identity->getUsername());
        $this->assertEquals('newuser@example.com', $identity->getEmail());
        $this->assertTrue(password_verify('secret123', $identity->getPasswordHash()));
        $this->assertEquals(10, $identity->getStatus());
    }
}
