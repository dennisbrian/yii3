<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Environment;
use Codeception\Test\Unit;

use function PHPUnit\Framework\assertSame;

final class EnvironmentTest extends Unit
{
    protected function _before(): void
    {
        Environment::prepare();
    }

    public function testAppEnv(): void
    {
        assertSame('test', Environment::appEnv());
    }

    public function testInvalidAppEnvThrowsException(): void
    {
        $originalEnv = getenv('APP_ENV');
        putenv('APP_ENV=invalid');

        try {
            $this->expectException(\RuntimeException::class);
            $this->expectExceptionMessage('APP_ENV="invalid" environment is invalid. Valid values are "dev", "test", "prod".');
            Environment::prepare();
        } finally {
            if ($originalEnv !== false) {
                putenv('APP_ENV=' . $originalEnv);
            } else {
                putenv('APP_ENV');
            }
        }
    }

    public function testEmptyAppEnvThrowsException(): void
    {
        $originalEnv = getenv('APP_ENV');
        // Unset the variable to simulate null value from getenv()
        putenv('APP_ENV');

        try {
            $this->expectException(\RuntimeException::class);
            $this->expectExceptionMessage('APP_ENV environment variable is empty. Valid values are "dev", "test", "prod".');
            Environment::prepare();
        } finally {
            if ($originalEnv !== false) {
                putenv('APP_ENV=' . $originalEnv);
            }
        }
    }
}
