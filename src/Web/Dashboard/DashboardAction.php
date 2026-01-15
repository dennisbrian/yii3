<?php

declare(strict_types=1);

namespace App\Web\Dashboard;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\User\CurrentUser;
use Yiisoft\Yii\View\Renderer\ViewRenderer;

/**
 * Dashboard Action - Protected Admin Page
 */
final readonly class DashboardAction
{
    public function __construct(
        private ViewRenderer $viewRenderer,
        private CurrentUser $currentUser,
    ) {}
    
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $identity = $this->currentUser->getIdentity();
        
        return $this->viewRenderer
            ->withViewPath(__DIR__)
            ->render('dashboard', [
                'identity' => $identity,
            ]);
    }
}
