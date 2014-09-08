<?php
namespace Repositories\InpostApi;

interface InpostApiInterface {

	public function getCustomerByEmail($email);

	public function getParcels($email);

	public function createParcel($postFields, $email);

	public function payParcel($parcel_id);

	public function cancelParcel($parcel_id);

}