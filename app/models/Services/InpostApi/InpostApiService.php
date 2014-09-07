<?php namespace Services\InpostApi;

use Repositories\InpostApi\InpostApiInterface;

/**
* Our InpostApiService, containing all useful methods for business logic around InpostApi
*/
class InpostApiService implements \Robbo\Presenter\PresentableInterface
{
    // Containing our InpostApiRepository to make all our database calls to
    protected $inpostRepo;
    
    /**
    * Loads our $inpostApiRepo with the actual Repo associated with our InpostApiInterface
    * 
    * @param InpostApiInterface $inpostApiRepo
    * @return InpostApiService
    */
    public function __construct(InpostApiInterface $inpostApiRepo)
    {
        $this->inpostRepo = $inpostApiRepo;
    }

    /**
     * Method to get Inpost API business logic, so you dont have to call statics all the time (repository behind it)
     * 
     * @return Services\InpostApi\InpostApiService Object
     */
    public function getInpostModel()
    {
        return $this;
    }

    /**
    * Method to get inpostApi repository
    * 
    * @param mixed $inpostApi
    * @return string
    */
    public function getInpostApi()
    {
        // If nothing found, return this simple string
        return $this->inpostRepo;
    }

    public function getCustomer($email) {
        $customer = $this->inpostRepo->getCustomerByEmail($email);

        if( $customer->getStatusCode() == 200 )
            return $customer->json();
        else
            return false;
    }

    /**
     * Return a created presenter.
     *
     * @return Robbo\Presenter\Presenter
     */
    public function getPresenter()
    {
        return new \Presenter\InpostApiPresenter($this);
    }

}