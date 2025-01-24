<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        
        Blade::directive('highlightStatus', function ($status) {
            return "<?php echo ($status == 'special') ? 'class=\"special-item\"' : (($status == 'work') ? 'class=\"work-item\"' : ''); ?>";
        });
    }
}
