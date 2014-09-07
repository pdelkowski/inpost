<?php

class HomeController extends BaseController {

	/**
	 * Holds Inpost API Business Logic
	 * 
	 * @var Services\InpostApi\InpostApiService Object
	 */
	protected $api;

	/**
	 * For this project every request has InpostApi pass via DI (Dependency Injection)
	 * If you dont need this, delete constructor and if you need Inpost API 
	 * go with $var = InpostApi::getInpostModel();
	 * InpostApi is an alias for \Services\InpostApi\InpostApiFacade
	 * 
	 * @param InpostApi $api \Services\InpostApi\InpostApiFacade
	 */
	public function __construct(InpostApi $api) {
		$this->api = $api::getInpostModel();
	}

	public function hello() {
		$user_email = 'web-dev@easypack24.net';

		$customer = $this->api->getCustomer($user_email);
		
		return 	View::make('home')
				->with('customer', $customer);

	}

}