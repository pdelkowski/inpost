<?php

namespace Repositories\InpostApi;

use \stdClass;
use \Guzzle\Http\Client;
use \CommerceGuys\Guzzle\Plugin\Oauth2\Oauth2Plugin;
use \Guzzle\Http\Exception\ClientErrorResponseException as ResponseException;

class InpostApiRepository extends \Repositories\BaseRepository implements InpostApiInterface {

	use \KirkBushell\Fatty\Context;

	/**
	 * Var holds an API address
	 * 
	 * @var string
	 */
	private $_api_address;

	/**
	 * Var holds a API token
	 * 
	 * @var string
	 */
	private $_api_token;

	/**
	 * Var holds client API object
	 * @var GuzzleHttp\Client Object
	 */
	private $client;


	/**
	 * Constructor, set connection
	 */
	public function __construct() {
		$this->_api_address 	= $_ENV['INPOST_API_ADDRESS'];
		$this->_api_version		= $_ENV['INPOST_API_VERSION'];
		$this->_api_token 		= $_ENV['INPOST_API_TOKEN'];

		$accessToken = array('access_token' => "$this->_api_token");
		$oauth2Plugin = new Oauth2Plugin();
		$oauth2Plugin->setAccessToken($accessToken);

		$this->client = new Client("$this->_api_address/{version}", array('version' => $this->_api_version));
		$this->client->addSubscriber($oauth2Plugin);
	}

	/**
	 * API call for customer details
	 * 
	 * @param  string $email
	 * @return Guzzle\Http\Message\Response API call response
	 */
	public function getCustomerByEmail($email) {

		try {
		    $request = $this->client->get("customers/$email"); 
		    $response = $request->send();
		} catch (ResponseException $e) {
	        $response = $e->getResponse();
		    
		}

		return $response;
	}

	/**
	 * API call to get all customer's parcels
	 * 
	 * @param  string $email
	 * @return Guzzle\Http\Message\Response API call response
	 */
	public function getParcels($email) {

		try {
			$request = $this->client->get("customers/$email/parcels");
			$response = $request->send();

		} catch (ResponseException $e) {
			$response = $e->getResponse();
		}

		return $response;
	}

	/**
	 * API call to create new parcel
	 * 
	 * @param  array $postFields Array with POST fields
	 * @param  string $email
	 * @return Guzzle\Http\Message\Response API call response
	 */
	public function createParcel($postFields, $email) {

        try {
        	$request = $this->client->post("customers/$email/parcels", array(), $postFields);
        	$response = $request->send();
        } catch (ResponseException $e) {
			$response = $e->getResponse();
		}

		return $response;
	}

	/**
	 * API call to pay for the parcel
	 * 
	 * @param  string $parcel_id
	 * @return Guzzle\Http\Message\Response API call response
	 */
	public function payParcel($parcel_id) {

		try {
			$request = $this->client->post("parcels/$parcel_id/pay");
        	$response = $request->send();
        } catch (ResponseException $e) {
			$response = $e->getResponse();
		}

        return $response;
	}

	/**
	 * API call to cancel the parcel
	 * 
	 * @param  string $parcel_id
	 * @return Guzzle\Http\Message\Response API call response
	 */
	public function cancelParcel($parcel_id) {

		try {
			$request = $this->client->post("parcels/$parcel_id/cancel");
        	$response = $request->send();
        } catch (ResponseException $e) {
			$response = $e->getResponse();
		}

        return $response;
	}

	/**
	 * Returns stdClass object of Inpost API, data-source may change we return an object of the same format
	 */
	protected function convertFormat($inpostApi) {
		// return $inpostApi ? (object) $inpostApi->toArray() : null;
	}

}