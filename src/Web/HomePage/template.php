<?php

declare(strict_types=1);

use App\Shared\ApplicationParams;
use Yiisoft\View\WebView;

/**
 * @var WebView $this
 * @var ApplicationParams $applicationParams
 */

$this->setTitle($applicationParams->name);
?>

<!-- Hero Section with Gradient Background -->
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 -m-8 p-8">
    
    <!-- Animated Background Orbs -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-20 w-72 h-72 bg-yii-primary/30 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-yii-secondary/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 flex flex-col items-center justify-center min-h-[80vh] text-center px-4">
        
        <!-- Logo Animation -->
        <div class="mb-8 animate-bounce">
            <div class="w-24 h-24 bg-gradient-to-br from-yii-primary to-yii-secondary rounded-2xl shadow-2xl flex items-center justify-center transform rotate-12 hover:rotate-0 transition-transform duration-500">
                <span class="text-white text-4xl font-bold">Y3</span>
            </div>
        </div>

        <!-- Heading -->
        <h1 class="text-5xl md:text-7xl font-bold text-white mb-6">
            Welcome to <span class="text-gradient bg-gradient-to-r from-yii-primary to-yii-secondary bg-clip-text text-transparent">Yii3</span>
        </h1>
        
        <!-- Subheading -->
        <p class="text-xl md:text-2xl text-slate-300 max-w-2xl mb-10">
            The next-generation PHP framework for building modern, scalable web applications with
            <span class="text-yii-primary font-semibold">speed</span> and 
            <span class="text-yii-secondary font-semibold">elegance</span>.
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 mb-16">
            <a href="https://yiisoft.github.io/docs/guide/" target="_blank" rel="noopener"
               class="px-8 py-4 bg-yii-primary text-white font-semibold rounded-xl 
                      shadow-lg shadow-yii-primary/50 hover:shadow-xl hover:shadow-yii-primary/60
                      transform hover:-translate-y-1 transition-all duration-300">
                📚 Read the Guide
            </a>
            <a href="https://github.com/yiisoft/app" target="_blank" rel="noopener"
               class="px-8 py-4 bg-white/10 backdrop-blur-sm text-white font-semibold rounded-xl
                      border border-white/20 hover:bg-white/20
                      transform hover:-translate-y-1 transition-all duration-300">
                ⭐ Star on GitHub
            </a>
        </div>

        <!-- Feature Cards -->
        <div class="grid md:grid-cols-3 gap-6 max-w-5xl w-full">
            <!-- Card 1: Performance -->
            <div class="glass-card bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/10 
                        hover:border-yii-primary/50 transition-all duration-300 group">
                <div class="text-4xl mb-4 group-hover:scale-110 transition-transform duration-300">⚡</div>
                <h3 class="text-xl font-bold text-white mb-2">Lightning Fast</h3>
                <p class="text-slate-400">Optimized for high performance with minimal overhead and lazy loading.</p>
            </div>
            
            <!-- Card 2: Modern -->
            <div class="glass-card bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/10 
                        hover:border-yii-secondary/50 transition-all duration-300 group">
                <div class="text-4xl mb-4 group-hover:scale-110 transition-transform duration-300">🎯</div>
                <h3 class="text-xl font-bold text-white mb-2">Modern PHP</h3>
                <p class="text-slate-400">Built with PHP 8.2+ features, PSR compliance, and clean architecture.</p>
            </div>
            
            <!-- Card 3: Tailwind Ready -->
            <div class="glass-card bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/10 
                        hover:border-yii-orange/50 transition-all duration-300 group">
                <div class="text-4xl mb-4 group-hover:scale-110 transition-transform duration-300">🎨</div>
                <h3 class="text-xl font-bold text-white mb-2">Tailwind Ready</h3>
                <p class="text-slate-400">Integrated with Tailwind CSS for beautiful, responsive designs.</p>
            </div>
        </div>
    </div>

    <!-- Footer Stats -->
    <div class="relative z-10 mt-16 text-center">
        <div class="inline-flex flex-wrap justify-center gap-8 text-slate-400 text-sm">
            <div class="flex items-center gap-2">
                <span class="text-yii-primary">●</span>
                <span>PHP 8.2+</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-yii-secondary">●</span>
                <span>PSR Compliant</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-yii-orange">●</span>
                <span>Docker Ready</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-white">●</span>
                <span>Tailwind CSS</span>
            </div>
        </div>
    </div>
</div>
