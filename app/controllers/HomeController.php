<?php

class HomeController extends BaseController {

	/**
	 * Holds Inpost API Business Logic
	 * 
	 * @var Services\InpostApi\InpostApiService Object
	 */
	protected $api;

	/**
	 * Holds customer email to make calls easier
	 * @var string
	 */
	protected $_customer_email;

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
		$_customer_email = 'web-dev@easypack24.net';
		$this->api->storeCustomerEmail($_customer_email);
	}

	/**
	 * Show main page view
	 * 
	 * @return Robbo\Presenter\View\View
	 */
	public function home() {
		
		$customer = $this->api->getCustomer();
		$parcels = $this->api->getCustomerParcels();

		return 	View::make('home')
				->with('customer', $customer);
	}

	/**
	 * Show customer details view
	 * 
	 * @return Robbo\Presenter\View\View
	 */
	public function showCustomer() {
		$customer = $this->api->getCustomer();
		$statusCode = $customer->getStatusCode();

		if(  $statusCode != 200 ) {
			if( $statusCode == 404 ) {
				return 	Redirect::route('home')
						->with('global_error', _("Error: $statusCode. Customer not found")); // you should apply translation for every error
			}
			else {
				return 	Redirect::route('home')
						->with('global_error', 'There occur an error while processing your request');
			}
		}

		return 	View::make('customer')
				->with('customer', $customer->json());
	}

	/**
	 * Show list of parcels view
	 * 
	 * @return Robbo\Presenter\View\View
	 */
	public function showParcels() {
		$parcels = $this->api->getCustomerParcels();
		$statusCode = $parcels->getStatusCode();

		if(  $statusCode != 200 ) {
			return 	Redirect::route('home')
					->with('global_error', 'There occur an error while processing your request');
		}

		return 	View::make('parcels')
				->with('parcels', $parcels->json());
	}

	/**
	 * Pay for the parcel action
	 * 
	 * @param  string $parcel_id Id of parcel which you want to pay for
	 * @return Illuminate\Http\RedirectResponse Redirect to home page
	 */
	public function payParcel($parcel_id) {
		$response = $this->api->payParcel($parcel_id);
		$statusCode = $response->getStatusCode();

		if(  $statusCode != 200 ) {
			if( $statusCode == 403 ) {
				return 	Redirect::route('home')
						->with('global_error', "Error: $statusCode. You're not allowed to pay for that parcel");
			}
			else if( $statusCode == 404 ) {
				return 	Redirect::route('home')
						->with('global_error', "Error: $statusCode. Parcel not found");
			}
			else if( $statusCode == 422 ) {
				return 	Redirect::route('home')
						->with('global_error', "Error: $statusCode. Probably you have lack of funds top pay for that parcel. Top up your account and try again");
			}
			else {
				return 	Redirect::route('home')
						->with('global_error', 'There occur an error while processing your request');
			}
		}

		return 	Redirect::route('home')
				->with('global_success', "The parcel has been paid");
	}

	/**
	 * Cancel parcel action
	 * 
	 * @param  string $parcel_id Id of a parcel which to want to delete delete
	 * @return Illuminate\Http\RedirectResponse Redirect to home page
	 */
	public function cancelParcel($parcel_id) {
		$response = $this->api->cancelParcel($parcel_id);
		$statusCode = $response->getStatusCode();

		if(  $statusCode != 200 ) {
			if( $statusCode == 403 ) {
				return 	Redirect::route('home')
						->with('global_error', "Error: $statusCode. You're not allowed to pay for that parcel");
			}
			else if( $statusCode == 404 ) {
				return 	Redirect::route('home')
						->with('global_error', "Error: $statusCode. Parcel not found");
			}
			else if( $statusCode == 422 ) {
				return 	Redirect::route('home')
						->with('global_error', "Error: $statusCode. Parcel is in invalid status. Only parcels with created status can be canceled");
			}
			else {
				return 	Redirect::route('home')
						->with('global_error', 'There occur an error while processing your request');
			}
		}

		return 	Redirect::route('home')
				->with('global_success', "The parcel has been cancelled");
	}

	/**
	 * Show form to add new parcel
	 * 
	 * @return Robbo\Presenter\View\View
	 */
	public function createParcelForm() {
		return View::make('parcels_create_get');
	}

	/**
	 * Create new parcel action and redirect to home page
	 * 
	 * @return Illuminate\Http\RedirectResponse Redirect to home page
	 */
	public function createParcel() {
		// There is no validation since API takes care of it
		$data = array(
			'size' => Input::get('size'),
			'sender_machine_id' => Input::get('sender_machine_id'),
			'target_machine_id' => Input::get('target_machine_id'),
			'receiver_phone' => Input::get('receiver_phone'),
			'receiver_email' => Input::get('receiver_email'),
			'customer_reference' => Input::get('customer_reference'),
			'sender_address' => array(
				'building_no' => Input::get('building_no'),
				'flat_no' => Input::get('flat_no'),
				'city' => Input::get('city'),
				'street' => Input::get('street'),
				'post_code' => Input::get('post_code')
			)
		);
		
		$response = $this->api->createParcel($data);
		$statusCode = $response->getStatusCode();

		if(  $statusCode != 201 ) {
		
			if( $statusCode == 400 ) {
				return 	Redirect::route('home')
						->with('global_error', "Error: $statusCode. You entered invalid data.");
			}
			else if( $statusCode == 422 ) {
				return 	Redirect::route('home')
						->with('global_error', "Error: $statusCode. Really weird error I'm getting.");
			}
			else {
				return 	Redirect::route('home')
						->with('global_error', 'There occur an error while processing your request.');
			}
		}

		return 	Redirect::route('home')
				->with('global_success', "New parcel has been created");

	}

}