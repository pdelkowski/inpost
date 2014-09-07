<?php

namespace Repositories\InpostApi;

use Repositories\InpostApi\InpostApiRepository;
use Illuminate\Support\ServiceProvider;

class InpostApiRepositoryServiceProvider extends ServiceProvider {

	/**
    * Registers the InpostApiInterface with Laravels IoC Container
    * 
    */
    public function register()
    {
        // Bind the returned class to the namespace 'Repositories\InpostApiInterface
        $this->app->bind('Repositories\InpostApi\InpostApiInterface', function($app)
        {
            return new InpostApiRepository(new \InpostApi());
        });
    }
}