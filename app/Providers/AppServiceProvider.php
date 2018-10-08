<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Blade::directive('money', function ($valor) {
            return "<?php echo 'R$ ' . number_format($valor, 2, ',', '.'); ?>";
        });
    }

    public function register()
    {
        //
    }
}
