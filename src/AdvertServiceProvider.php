<?php
namespace LudwigHeymbeeck\LaravelAdvert;

use Illuminate\Support\ServiceProvider;

class AdvertServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__ . '/routes.php';
        $this->app->make('LudwigHeymbeeck\LaravelAdvert\AdvertManagerController');
        $this->app->singleton('advert_manager', function() {
            return new AdvertManager();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['advert_manager'];
    }
}
