<?php namespace Services\InpostApi;

use Illuminate\Support\ServiceProvider;

/**
* Register our InpostApi service with Laravel
*/
class InpostApiServiceServiceProvider extends ServiceProvider 
{
    /**
    * Registers the service in the IoC Container
    * 
    */
    public function register()
    {
        // Binds 'InpostApiService' to the result of the closure
        $this->app->bind('InpostApiService', function($app)
        {
            return new InpostApiService(
                // Inject in our class of InpostApiInterface, this will be our repository
                $app->make('Repositories\InpostApi\InpostApiInterface')
            );
        });
    }
}