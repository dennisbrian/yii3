<?php

declare(strict_types=1);

namespace App\Web\Auth;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Http\Status;
use Yiisoft\User\CurrentUser;
use HttpSoft\Message\Response;

/**
 * Logout Action for Yii3
 */
final readonly class LogoutAction
{
    public function __construct(
        private CurrentUser $currentUser,
    ) {}
    
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $this->currentUser->logout();
        
        $response = new Response(Status::FOUND);
        return $response->withHeader('Location', '/');
    }
}
