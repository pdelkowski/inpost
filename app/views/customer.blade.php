@extends('layout.main')

@section('content')
	<h1>Customer page!</h1>
	<p>Welcome, {{ $customer['email'] }}</p>
	<p>Default machine ID: {{ $customer['default_machine_id'] }}</p>
	<p>Account balance: {{ $customer['account_balance'] }}</p>

	<br><br>
	<p><label>Address</label></p>
	<p>Postal code: {{ $customer['address']['post_code'] }}</p>

@stop