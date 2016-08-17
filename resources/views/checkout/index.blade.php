@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Checkout</h2>
			</div>
			<form method="POST" action="{{ route('checkout') }}">
				{{ csrf_field() }}
				<div class="col-md-4">
					<h3>1. Billing Information</h3>
					<div class="form-group">
						<label for="email">Email Address</label>
						<input type="email" 
							id="email" 
							name="email" 
							value="{{ old('email') }}" 
							class="form-control" />
					</div>

					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" 
							id="name" 
							name="name" 
							value="{{ old('name') }}" 
							class="form-control" />
					</div>

					<div class="form-group">
						<label for="phone">Phone</label>
						<input type="text" 
							id="phone" 
							name="phone" 
							value="{{ old('phone') }}" 
							class="form-control" />
					</div>

					<div class="form-group">
						<label for="address">Address</label>
						<input type="text" 
							id="address" 
							name="address" 
							value="{{ old('address') }}" 
							class="form-control" />
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="city">City</label>
								<input type="text" 
									id="city" 
									name="city" 
									value="{{ old('city') }}" 
									class="form-control" />
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="state">State/Province</label>
								<input type="text" 
									id="state" 
									name="state" 
									value="{{ old('state') }}" 
									class="form-control" />
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="country">Country</label>
						<input type="text" 
							name="country" 
							id="country" 
							value="{{ old('country') }}" 
							class="form-control" />
					</div>

					<h3>Create your account</h3>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" class="form-control" />
					</div>

					<div class="form-group">
						<label for="password">Repeat Password</label>
						<input type="password" name="password_confirmation" class="form-control" />
					</div>
				</div>

				<div class="col-md-4">
					<h3>2. Shipping Method</h3>

					<h3>3. Payment Method</h3>
					<div class="radio">
						<label>
							<input type="radio" name="payment" value="cash" /> Cash on delivery
						</label>
					</div>

					<div class="radio">
						<label>
							<input type="radio" name="payment" value="card" /> Credit Card
						</label>
					</div>
				</div>

				<div class="col-md-4">
					<h3>4. Review Order</h3>

					<div class="checkbox">
						<label>
							<input type="checkbox" name="terms" />
							I read &amp; agree the Terms and Conditions.
						</label>
					</div>

					<button type="submit" class="btn btn-primary btn-large">
						Place order
					</button>
				</div>
			</form>
		</div>
	</div>

	@forelse( $cart as $item )
		<li>
			{{ $item->name }}
		</li>
	@empty
		<p>Shopping cart is empty.</p>
	@endforelse
@endsection