<?php

declare(strict_types=1);

use App\Shared\ApplicationParams;
use Yiisoft\View\WebView;

/**
 * @var WebView $this
 * @var ApplicationParams $applicationParams
 * @var string|null $error
 */

$this->setTitle('Login - ' . $applicationParams->name);
?>

<div class="min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 flex items-center justify-center px-4 -m-8 p-8">
    
    <!-- Animated Background -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-20 w-72 h-72 bg-yii-primary/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-yii-secondary/15 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>
    
    <!-- Login Card -->
    <div class="relative z-10 w-full max-w-md">
        <div class="bg-white/10 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/20 p-8">
            
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-yii-primary to-yii-secondary rounded-2xl shadow-lg mb-4">
                    <span class="text-white text-2xl font-bold">Y3</span>
                </div>
                <h1 class="text-2xl font-bold text-white">Welcome Back</h1>
                <p class="text-slate-400 mt-2">Sign in to your account</p>
            </div>
            
            <!-- Error Alert -->
            <?php if ($error): ?>
            <div class="mb-6 p-4 bg-red-500/20 border border-red-500/50 rounded-xl text-red-200 text-sm">
                <?= htmlspecialchars($error) ?>
            </div>
            <?php endif; ?>
            
            <!-- Login Form -->
            <form method="POST" action="/login" class="space-y-6">
                <!-- CSRF Token -->
                <?= $csrf?->hiddenInput() ?? '' ?>
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300 mb-2">
                        Email Address
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        required
                        autocomplete="email"
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl 
                               text-white placeholder-slate-400
                               focus:outline-none focus:ring-2 focus:ring-yii-primary focus:border-transparent
                               transition-all duration-200"
                        placeholder="admin@example.com"
                    >
                </div>
                
                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-300 mb-2">
                        Password
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required
                        autocomplete="current-password"
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl 
                               text-white placeholder-slate-400
                               focus:outline-none focus:ring-2 focus:ring-yii-primary focus:border-transparent
                               transition-all duration-200"
                        placeholder="••••••••"
                    >
                </div>
                
                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full py-4 bg-gradient-to-r from-yii-primary to-blue-500 
                           text-white font-semibold rounded-xl
                           shadow-lg shadow-yii-primary/30
                           hover:shadow-xl hover:shadow-yii-primary/40
                           transform hover:-translate-y-0.5
                           transition-all duration-300"
                >
                    Sign In
                </button>
            </form>
            
            <!-- Footer -->
            <div class="mt-8 text-center">
                <a href="/" class="text-slate-400 hover:text-white text-sm transition-colors">
                    ← Back to Home
                </a>
            </div>
        </div>
        
        <!-- Help Text -->
        <p class="text-center text-slate-500 text-sm mt-6">
            Create admin: <code class="text-yii-primary">./yii user:create-admin email password</code>
        </p>
    </div>
</div>
