<?php namespace Services\InpostApi;

use \Illuminate\Support\Facades\Facade;

/**
* Facade class to be called whenever the class InpostApiService is called
*/
class InpostApiFacade extends Facade {

    /**
     * Get the registered name of the component. This tells $this->app what record to return
     * (e.g. $this->app[‘InpostApiService’])
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'InpostApiService'; }

}