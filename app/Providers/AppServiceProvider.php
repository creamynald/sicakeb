<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Http\Request;

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
    public function boot(): void
    {
        // Untuk Kebutuhan Mata Uang Indonesia
        Blade::directive('rp', function ( $expression ) { return "Rp. <?php echo number_format($expression,0,',','.'); ?>"; });
        // Untuk Url Segment
        Blade::directive('urlSegment', function ($expression) { return "<?php echo ucfirst(Request::segment($expression));  ?>"; });
    }
}
