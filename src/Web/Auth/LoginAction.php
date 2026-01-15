<?php

declare(strict_types=1);

namespace App\Web\Auth;

use App\User\IdentityRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Http\Method;
use Yiisoft\Http\Status;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\User\CurrentUser;
use Yiisoft\Yii\View\Renderer\ViewRenderer;
use HttpSoft\Message\Response;

/**
 * Login Action for Yii3
 * 
 * Handles both GET (show form) and POST (process login) requests.
 * This is the Yii3 way - actions are standalone classes, not controller methods.
 */
final readonly class LoginAction
{
    public function __construct(
        private ViewRenderer $viewRenderer,
        private CurrentUser $currentUser,
        private IdentityRepository $identityRepository,
        private UrlGeneratorInterface $urlGenerator,
    ) {}
    
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        // Already logged in? Redirect to dashboard
        if (!$this->currentUser->isGuest()) {
            return $this->redirect('/dashboard');
        }
        
        $error = null;
        
        // Handle POST (login attempt)
        if ($request->getMethod() === Method::POST) {
            $body = $request->getParsedBody();
            $email = $body['email'] ?? '';
            $password = $body['password'] ?? '';
            
            if ($email && $password) {
                $identity = $this->identityRepository->findByEmail($email);
                
                if ($identity !== null && $identity->validatePassword($password)) {
                    $this->currentUser->login($identity);
                    return $this->redirect('/dashboard');
                }
                
                $error = 'Invalid email or password';
            } else {
                $error = 'Please enter email and password';
            }
        }
        
        // Render login form
        return $this->viewRenderer
            ->withViewPath(__DIR__)
            ->render('login', [
                'error' => $error,
            ]);
    }
    
    private function redirect(string $path): ResponseInterface
    {
        $response = new Response(Status::FOUND);
        return $response->withHeader('Location', $path);
    }
}
