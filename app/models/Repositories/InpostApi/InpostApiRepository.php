<?php

namespace Repositories\InpostApi;

use \stdClass;
use \Guzzle\Http\Client;
use \CommerceGuys\Guzzle\Plugin\Oauth2\Oauth2Plugin;

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

		$accessToken = array('access_token' => 'f41052b8fc8dc925e1d73b0e9e553bd6b4b9eb21d5fb315227dbea78f0461481');
		$oauth2Plugin = new Oauth2Plugin();
		$oauth2Plugin->setAccessToken($accessToken);

		$this->client = new Client("$this->_api_address/{version}", array('version' => $this->_api_version));
		$this->client->addSubscriber($oauth2Plugin);
	}

	public function getCustomerByEmail($email) {

		try {
		    $request = $this->client->get("customers/$email"); 
		    $response = $request->send();
		} catch (RequestException $e) {
		    if ($e->hasResponse()) {
		        $response = $e->getResponse() . "\n";
		    }
		}

		return $response;
	}

	/**
	 * Returns stdClass object of Inpost API, data-source may change we return an object of the same format
	 */
	protected function convertFormat($inpostApi) {
		// return $inpostApi ? (object) $inpostApi->toArray() : null;
		return $inpostApi;
	}

}