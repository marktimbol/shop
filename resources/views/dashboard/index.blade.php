@extends('layouts.app')

@section('subheader')
	<div class="Subheader">
		<h2>Hello, {{ auth()->user()->name }}</h2>
	</div>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				@include('dashboard._sidebar')
			</div>
			<div class="col-md-9">
				<h2>Dashboard</h2>
				<p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>
			</div>
		</div>
	</div>
@endsection