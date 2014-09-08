<?php namespace Services\InpostApi;

use Repositories\InpostApi\InpostApiInterface;

/**
* Our InpostApiService, containing all useful methods for business logic around InpostApi
*/
class InpostApiService implements \Robbo\Presenter\PresentableInterface
{
    /**
     * Holds InpostApiRepository to access Data Persistence Layer (database
     * )
     * @var InpostApiInterface
     */
    protected $inpostRepo;

    /**
     * Var holds customer email to make calls easier, no need to pass email arg every time
     * 
     * @var string
     */
    protected $_customer_email = NULL;
    
    /**
    * Loads our $inpostApiRepo with the actual Repo associated with our InpostApiInterface
    * 
    * @param InpostApiInterface $inpostApiRepo
    * @return InpostApiService
    */
    public function __construct(InpostApiInterface $inpostApiRepo)
    {
        $this->inpostRepo = $inpostApiRepo;
        $this->_customer_email = '';
    }

    /**
     * Helper method which stores customer email so you dont have to pass customer email for many calls
     * 
     * @param  string $email Customer email to store
     * @return [type]        [description]
     */
    public function storeCustomerEmail($email) {
        $this->_customer_email = $email;
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

    /**
     * Return customer details
     * 
     * @param  string $email Customer email
     * @return Guzzle\Http\Message\Response API call response
     */
    public function getCustomer($email = NULL) {
        $email = !$email ? $this->_customer_email : $email;

        return $this->inpostRepo->getCustomerByEmail($email);
    }

    /**
     * Get all customer's parcels
     * 
     * @param  string $email Customer email
     * @return Guzzle\Http\Message\Response API call response
     */
    public function getCustomerParcels($email = NULL) {
        $email = !$email ? $this->_customer_email : $email;

        return $this->inpostRepo->getParcels($email);
    }

    /**
     * Create new parcel
     * 
     * @param  array $parcel_data Array with post fields to create new parcel
     * @param  string $email Customer email
     * @return Guzzle\Http\Message\Response API call response
     */
    public function createParcel($parcel_data, $email = NULL) {
        $email = !$email ? $this->_customer_email : $email;

        return $this->inpostRepo->createParcel($parcel_data, $email);
    }

    /**
     * Pay for the parcel
     * 
     * @param  string $parcel_id Parcel id for which you want to pay
     * @return Guzzle\Http\Message\Response API call response
     */
    public function payParcel($parcel_id) {
        return $this->inpostRepo->payParcel($parcel_id);
    }

    /**
     * Cancel the parcel
     * 
     * @param  string $parcel_id Id of the parcel you want to cancel
     * @return Guzzle\Http\Message\Response API call response
     */
    public function cancelParcel($parcel_id) {
        return $this->inpostRepo->cancelParcel($parcel_id);
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