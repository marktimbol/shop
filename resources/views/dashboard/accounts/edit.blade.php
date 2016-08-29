@extends('layouts.app')

@section('subheader')
	<div class="Subheader">
		<h2>Account Information</h2>
	</div>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				@include('dashboard._sidebar')
			</div>

			<div class="col-md-9">
				<h2>Edit account information</h2>

				<form method="POST" action="{{ route('dashboard.account.update') }}">
					{{ csrf_field() }}
					{!! method_field('PUT') !!}
					<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
						<label class="control-label" for="name">Name</label>
						<input type="text" 
							id="name" 
							name="name" 
							value="{{ auth()->user()->name }}" 
							class="form-control" />
						<span class="help-block">{{ $errors->first('name') }}</span>
					</div>
					<div class="form-group">
						<label class="control-label" for="email">Email Address</label>
						<input type="email" 
							id="email" 
							name="email" 
							value="{{ auth()->user()->email }}" 
							class="form-control" disabled />
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection