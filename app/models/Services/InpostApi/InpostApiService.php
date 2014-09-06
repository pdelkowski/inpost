<?php namespace Services\InpostApi;

use Repositories\InpostApi\InpostApiInterface;

/**
* Our InpostApiService, containing all useful methods for business logic around InpostApi
*/
class InpostApiService
{
    // Containing our InpostApiRepository to make all our database calls to
    protected $inpostApiRepo;
    
    /**
    * Loads our $inpostApiRepo with the actual Repo associated with our InpostApiInterface
    * 
    * @param InpostApiInterface $inpostApiRepo
    * @return InpostApiService
    */
    public function __construct(InpostApiInterface $inpostApiRepo)
    {
        $this->inpostApiRepo = $inpostApiRepo;
    }

    /**
    * Method to get inpostApi
    * 
    * @param mixed $inpostApi
    * @return string
    */
    public function getInpostApi()
    {
        // If nothing found, return this simple string
        return $this->inpostApiRepo;
    }
}