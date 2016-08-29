@extends('layouts.app')

@section('subheader')
	<div class="Subheader">
		<h2>Address Book</h2>
	</div>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				@include('dashboard._sidebar')
			</div>
			<div class="col-md-9">
				<h2>Update address</h2>

				<form method="POST" action="{{ route('dashboard.address.update') }}">
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

					<div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
						<label class="control-label" for="phone">Phone</label>
						<input type="text" 
							id="phone" 
							name="phone" 
							value="{{ auth()->user()->phone }}" 
							class="form-control" />
						<span class="help-block">{{ $errors->first('phone') }}</span>
					</div>

					<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
						<label class="control-label" for="address">Address</label>
						<input type="text" 
							id="address" 
							name="address" 
							value="{{ auth()->user()->address }}" 
							class="form-control" />
						<span class="help-block">{{ $errors->first('address') }}</span>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
								<label class="control-label" for="city">City</label>
								<input type="text" 
									id="city" 
									name="city" 
									value="{{ auth()->user()->city }}" 
									class="form-control" />
								<span class="help-block">{{ $errors->first('city') }}</span>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
								<label class="control-label" for="state">State/Province</label>
								<input type="text" 
									id="state" 
									name="state" 
									value="{{ auth()->user()->state }}" 
									class="form-control" />
								<span class="help-block">{{ $errors->first('state') }}</span>	
							</div>
						</div>
					</div>

					<div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
						<label class="control-label" for="country">Country</label>
						<input type="text" 
							name="country" 
							id="country" 
							value="{{ auth()->user()->country }}" 
							class="form-control" />
						<span class="help-block">{{ $errors->first('country') }}</span>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>	
@endsection