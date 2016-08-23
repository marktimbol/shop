@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Checkout</h2>
			</div>
			<form method="POST" action="{{ route('checkout') }}" id="billingForm">
				{{ csrf_field() }}
				<input type="hidden" name="stripeToken" />
				<div class="col-md-4">
					<h3>1. Billing Information</h3>
					<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
						<label class="control-label" for="email">Email Address</label>
						<input type="email" 
							id="email" 
							name="email" 
							value="{{ old('email') }}" 
							class="form-control" />
						<span class="help-block">{{ $errors->first('email') }}</span>
					</div>

					<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
						<label class="control-label" for="name">Name</label>
						<input type="text" 
							id="name" 
							name="name" 
							value="{{ old('name') }}" 
							class="form-control" />
						<span class="help-block">{{ $errors->first('name') }}</span>
					</div>

					<div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
						<label class="control-label" for="phone">Phone</label>
						<input type="text" 
							id="phone" 
							name="phone" 
							value="{{ old('phone') }}" 
							class="form-control" />
						<span class="help-block">{{ $errors->first('phone') }}</span>
					</div>

					<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
						<label class="control-label" for="address">Address</label>
						<input type="text" 
							id="address" 
							name="address" 
							value="{{ old('address') }}" 
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
									value="{{ old('city') }}" 
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
									value="{{ old('state') }}" 
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
							value="{{ old('country') }}" 
							class="form-control" />
						<span class="help-block">{{ $errors->first('country') }}</span>
					</div>

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
				</div>

				<div class="col-md-4">
					<h3>2. Payment Method</h3>
					<div class="radio">
						<label>
							<input type="radio" 
								name="payment" 
								value="cash" 
								checked /> 
								Cash on delivery
						</label>
					</div>

					<div class="radio">
						<label>
							<input type="radio" 
								name="payment" 
								value="card" 
								{{ old('payment') === 'card' ? 'checked' : '' }} /> 
								Credit Card
						</label>
					</div>

					<div class="alert alert-danger Payment__errors"></div>

					<div class="form-group">
						<label class="control-label" for="card_number">Name on Card</label>
						<input type="text" 
							id="card_name" 
							data-stripe="name" 
							value="Mark Timbol"
							class="form-control" />
					</div>

					<div class="form-group">
						<label class="control-label" for="card_number">Card Number</label>
						<input type="text" 
							id="card_number" 
							size="20" 
							data-stripe="number" 
							value="4242424242424242"
							class="form-control" />
					</div>

					<div class="row">
						<div class="col-md-7">
							<div class="row">
								<div class="col-md-12">
									<label class="control-label" for="card_expiry_month">Expiry (MM/YYYY)</label>
									<div class="form-group form-inline">
										<select data-stripe="exp-month" class="form-control">
											<option value=""></option>
											@foreach( range(1, 12) as $month )
												<option value="{{ $month }}" 
													{{ $month === 1 ? 'selected' : '' }}
												>
													{{ date('m', strtotime(sprintf('%s-%s', date('Y'), $month))) }} - 
													{{ date('F', strtotime(sprintf('%s-%s', date('Y'), $month))) }}
												</option>
											@endforeach
										</select>

										<select data-stripe="exp-year" class="form-control">
											<option value=""></option>
											@foreach( range(2016, date('Y') + 10) as $year )
												<option value="{{ $year }}" 
													{{ $year == date('Y') + 1 ? 'selected' : '' }}
												>
													{{ $year }}
												</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-5">
							<div class="form-group">
								<label class="control-label" for="card_cvc">CVC</label>
								<input type="text" 
									id="card_cvc"
									size="4" 
									data-stripe="cvc" 
									value="123"
									class="form-control" />
							</div>
						</div>
					</div>

					<h3>Have coupon?</h3>
					<div class="form-group form-inline">
						<input type="text" name="coupon" class="form-control" value="{{ old('coupon') }}" />
						<button class="btn btn-primary">Apply coupon</button>
					</div>
				</div>

				<div class="col-md-4">
					<h3>3. Review Order</h3>
					@forelse( $cart as $item )
						<li>
							{{ $item->name }}
						</li>
					@empty
						<p>Shopping cart is empty.</p>
					@endforelse
					
					<div class="{{ $errors->has('terms') ? 'has-error' : '' }}">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="terms" />
								I read &amp; agree the Terms and Conditions.
							</label>
						</div>
					</div>

					<button type="submit" class="btn btn-success btn-lg place-order">
						Place order
					</button>
				</div>
			</form>
		</div>
	</div>
@endsection

@section('footer')
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script type="text/javascript">
		Stripe.setPublishableKey('pk_test_FdWDhqgmFddybwXdk6GOL1fH');
	</script>
@endsection