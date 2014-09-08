@extends('layout.main')

@section('content')

	<h1>Parcel page!</h1>
	<table class="table table-hover">
		<th>Parcel ID</th>
		<th>Status</th>
		<th>Target machine</th>
		<th>Source machine</th>
		<th>Created</th>
		<th>Actions</th>

		<tr>
			<td>(demo row) #981723948734</td>
			<td>prepared</td>
			<td>ELB164</td>
			<td>KRA252</td>
			<td>2014-02-10T12:15:16</td>
			<td>
				<a href="{{ route('parcel-pay', array(1)) }}" class="pay-action" data-toggle="tooltip" data-placement="top" title="Pay for the parcel"><i class="glyphicon glyphicon-usd"></i></a>
				<a href="{{ route('parcel-cancel', array(1)) }}" class="delete-action" data-toggle="tooltip" data-placement="top" title="Cancel the parcel"><i class="glyphicon glyphicon-trash"></i></a>
			</td>
		</tr>

		@if( $parcels )
			@foreach( $parcels['_embedded']['parcels'] as $parcel )
			<tr>
				<td>#{{ $parcel['id'] }}</td>
				<td>{{ $parcel['status'] }}</td>
				<td>{{ $parcel['target_machine'] }}</td>
				<td></td>
				<td>{{ $parcel['created_at'] }}</td>
				<td>
					<a href="{{ route('parcel-pay', array($parcel['id'])) }}" class="pay-action" data-toggle="tooltip" data-placement="top" title="Pay for the parcel"><i class="glyphicon glyphicon-usd"></i></a>
					<a href="{{ route('parcel-cancel', array($parcel['id'])) }}" class="delete-action" data-toggle="tooltip" data-placement="top" title="Cancel the parcel"><i class="glyphicon glyphicon-trash"></i></a>
				</td>
			</tr>
			@endforeach
		@endif

	</table>
@stop

@section('footer_scripts')

{{ HTML::script('js/jquery.confirm.min.js'); }}

<script type="text/javascript">
	$(".delete-action").confirm({
	    text: "Are you sure you want to cancel this parcel ?",
	    title: "Confim",
	    confirmButton: "Yes",
	    cancelButton: "No"
	});

	$(".pay-action").confirm({
	    text: "This is just a demo payment feature so in real life now you would be redirected to PayPal or something like this, for now just click 'Pay' ?",
	    title: "Notification",
	    confirmButton: "Pay",
	    cancelButton: "Cancel"
	});
</script>

@stop