<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class TestMiddleware extends Command
{
    protected $signature = 'test:middleware';
    protected $description = 'Test if role middleware is registered';

    public function handle()
    {
        $middleware = app('router')->getMiddleware();
        
        $this->info('Registered Middleware Aliases:');
        foreach ($middleware as $alias => $class) {
            $this->line("  {$alias} => {$class}");
        }
        
        // Check specific routes
        $this->info("\nChecking admin routes:");
        $route = Route::getRoutes()->getByName('admin.dashboard');
        if ($route) {
            $this->line("  Route 'admin.dashboard' middleware: " . implode(', ', $route->gatherMiddleware()));
        }
        
        $this->info("\nChecking customer routes:");
        $route = Route::getRoutes()->getByName('customer.dashboard');
        if ($route) {
            $this->line("  Route 'customer.dashboard' middleware: " . implode(', ', $route->gatherMiddleware()));
        }
        
        return 0;
    }
}