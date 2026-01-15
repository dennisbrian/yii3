<?php

declare(strict_types=1);

use App\Shared\ApplicationParams;
use App\User\Identity;
use Yiisoft\View\WebView;

/**
 * @var WebView $this
 * @var ApplicationParams $applicationParams
 * @var Identity $identity
 */

$this->setTitle('Dashboard - ' . $applicationParams->name);
?>

<div class="min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 -m-8 p-8">
    
    <!-- Top Bar -->
    <div class="flex justify-between items-center mb-8">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-gradient-to-br from-yii-primary to-yii-secondary rounded-xl flex items-center justify-center">
                <span class="text-white font-bold">Y3</span>
            </div>
            <h1 class="text-2xl font-bold text-white">Admin Dashboard</h1>
        </div>
        
        <div class="flex items-center gap-4">
            <span class="text-slate-400">
                Welcome, <span class="text-yii-primary font-semibold"><?= htmlspecialchars($identity->getEmail()) ?></span>
            </span>
            <a href="/logout" 
               class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg transition-colors">
                Logout
            </a>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/10">
            <div class="text-3xl mb-2">👤</div>
            <div class="text-2xl font-bold text-white">1</div>
            <div class="text-slate-400 text-sm">Total Users</div>
        </div>
        
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/10">
            <div class="text-3xl mb-2">🔐</div>
            <div class="text-2xl font-bold text-white">2</div>
            <div class="text-slate-400 text-sm">Roles</div>
        </div>
        
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/10">
            <div class="text-3xl mb-2">🛡️</div>
            <div class="text-2xl font-bold text-white">3</div>
            <div class="text-slate-400 text-sm">Permissions</div>
        </div>
        
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/10">
            <div class="text-3xl mb-2">✅</div>
            <div class="text-2xl font-bold text-yii-secondary">Active</div>
            <div class="text-slate-400 text-sm">System Status</div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- User Info Card -->
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/10">
            <h2 class="text-xl font-bold text-white mb-4">Your Account</h2>
            <div class="space-y-3">
                <div class="flex justify-between py-2 border-b border-white/10">
                    <span class="text-slate-400">User ID</span>
                    <span class="text-white font-mono"><?= htmlspecialchars($identity->getId()) ?></span>
                </div>
                <div class="flex justify-between py-2 border-b border-white/10">
                    <span class="text-slate-400">Email</span>
                    <span class="text-white"><?= htmlspecialchars($identity->getEmail()) ?></span>
                </div>
                <div class="flex justify-between py-2 border-b border-white/10">
                    <span class="text-slate-400">Username</span>
                    <span class="text-white"><?= htmlspecialchars($identity->getUsername()) ?></span>
                </div>
                <div class="flex justify-between py-2">
                    <span class="text-slate-400">Status</span>
                    <span class="px-2 py-1 bg-yii-secondary/20 text-yii-secondary rounded-full text-sm">Active</span>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions Card -->
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/10">
            <h2 class="text-xl font-bold text-white mb-4">Quick Actions</h2>
            <div class="space-y-3">
                <a href="/" class="flex items-center gap-3 p-3 bg-white/5 hover:bg-white/10 rounded-xl transition-colors">
                    <span class="text-2xl">🏠</span>
                    <div>
                        <div class="text-white font-semibold">Home Page</div>
                        <div class="text-slate-400 text-sm">View public homepage</div>
                    </div>
                </a>
                <a href="/login" class="flex items-center gap-3 p-3 bg-white/5 hover:bg-white/10 rounded-xl transition-colors">
                    <span class="text-2xl">🔑</span>
                    <div>
                        <div class="text-white font-semibold">Login Page</div>
                        <div class="text-slate-400 text-sm">View login form</div>
                    </div>
                </a>
                <div class="flex items-center gap-3 p-3 bg-yii-primary/20 rounded-xl border border-yii-primary/30">
                    <span class="text-2xl">💡</span>
                    <div>
                        <div class="text-yii-primary font-semibold">Yii3 + RBAC Working!</div>
                        <div class="text-slate-400 text-sm">Authentication is active</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="mt-8 text-center text-slate-500 text-sm">
        Powered by Yii3 + Tailwind CSS | RBAC Enabled
    </div>
</div>
