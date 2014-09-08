@extends('layout.main')

@section('jumbotron')
	<!-- Jumbotron Header -->
    <header class="jumbotron hero-spacer">
        <h1>Welcome!</h1>
        <p>This is simple system to browse customer parcels. You can create new ones as well! Extra features like cancelling, paying for parcels. You can see customer details, also. IT'S VERY FLEXIBLE SYSTEM BASED ON REPOSITORY DESIGN PATTERN AND SERVICE ORIENTATED ACHITECTURE WITH PRESENTERS FOR VIEWS AND EASY EXTENSION FEATURES.</p>
        <p><a href="{{ route('parcels-show') }}" class="btn btn-primary btn-large">Parcel list!</a>
        </p>
    </header>
 @stop

@section('content')
	<h1>Main page!</h1>

	@if(Session::has('global_error'))
		<br>
        <p class="alert alert-danger">{{ Session::get('global_error') }}</p>
    @endif

    @if(Session::has('global_success'))
    	<br>
        <p class="alert alert-success">{{ Session::get('global_success') }}</p>
    @endif
    
@stop