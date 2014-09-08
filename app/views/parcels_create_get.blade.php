@extends('layout.main')

@section('content')

<div class="col-lg-6">
	<h1>Create new percel</h1>
	{{ Form::open(array('route' => 'parcel-create-post', 'method' => 'post')) }}
	    <div class="form-group">
		    <input type="text" name="size" class="form-control" placeholder="Size (eg. A)">
	    </div>
	    <div class="form-group">
		    <input type="text" name="sender_machine_id" class="form-control" placeholder="Sender machine (eg. KRA253)">
	    </div>
	    <div class="form-group">
		    <input type="text" name="target_machine_id" class="form-control" placeholder="Target machine (eg. KRA253)">
	    </div>
	    <div class="form-group">
		    <input type="text" name="receiver_phone" class="form-control" placeholder="Receiver phone">
	    </div>
	    <div class="form-group">
		    <input type="text" name="receiver_email" class="form-control" placeholder="Receiver email">
	    </div>
	    <textarea class="form-control" name="customer_reference" rows="3" placeholder="Additional description"></textarea>

		<br>
		<strong>Sender address</strong>
	    <div class="form-group">
		    <input type="text" name="building_no" class="form-control" placeholder="Building No.">
	    </div>
	    <div class="form-group">
		    <input type="text" name="flat_no" class="form-control" placeholder="Flat No.">
	    </div>
	    <div class="form-group">
		    <input type="text" name="city" class="form-control" placeholder="City">
	    </div>
	    <div class="form-group">
		    <input type="text" name="street" class="form-control" placeholder="Street">
	    </div>
	    <div class="form-group">
		    <input type="text" name="post_code" class="form-control" placeholder="Postal code">
	    </div>

	  	<button type="submit" class="btn btn-default btn-success">Add</button>
	{{ Form::close() }}
</div>

@stop