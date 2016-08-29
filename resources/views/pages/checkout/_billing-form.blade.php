<div class="Subpage__subtitle--container">
	<h3 class="Subpage__subtitle">1. Billing Information</h3>
</div>

@if( ! auth()->check() )
	<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
		<label class="control-label" for="email">Email Address</label>
		<input type="email" 
			id="email" 
			name="email" 
			value="{{ old('email') }}" 
			class="form-control" />
		<span class="help-block">{{ $errors->first('email') }}</span>
	</div>
@endif

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
	<label class="control-label" for="name">Name</label>
	<input type="text" 
		id="name" 
		name="name" 
		value="{{ auth()->check() ? auth()->user()->name : old('name') }}" 
		class="form-control" />
	<span class="help-block">{{ $errors->first('name') }}</span>
</div>

<div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
	<label class="control-label" for="phone">Phone</label>
	<input type="text" 
		id="phone" 
		name="phone" 
		value="{{ auth()->check() ? auth()->user()->phone : old('phone') }}" 
		class="form-control" />
	<span class="help-block">{{ $errors->first('phone') }}</span>
</div>

<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
	<label class="control-label" for="address">Address</label>
	<input type="text" 
		id="address" 
		name="address" 
		value="{{ auth()->check() ? auth()->user()->address : old('address') }}" 
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
				value="{{ auth()->check() ? auth()->user()->city : old('city') }}" 
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
				value="{{ auth()->check() ? auth()->user()->state : old('state') }}" 
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
		value="{{ auth()->check() ? auth()->user()->country : old('country') }}" 
		class="form-control" />
	<span class="help-block">{{ $errors->first('country') }}</span>
</div>

@if( ! auth()->check() )
	<h3>Create your account</h3>
	<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
		<label class="control-label" for="password">Password</label>
		<input type="password" name="password" class="form-control" />
		<span class="help-block">{{ $errors->first('password') }}</span>
	</div>

	<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
		<label class="control-label" for="password">Repeat Password</label>
		<input type="password" name="password_confirmation" class="form-control" />
		<span class="help-block">{{ $errors->first('password_confirmation') }}</span>
	</div>
@endif