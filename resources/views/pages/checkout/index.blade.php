@extends('layouts.app')

@section('subheader')
	<div class="Subheader">
		<h2>Checkout</h2>
	</div>
@endsection

@section('content')
	<div class="container Checkout">
		<div class="row">
			<div id="Checkout"></div>
		</div>
	</div>
@endsection

@section('footer_scripts')
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script type="text/javascript">
		Stripe.setPublishableKey('pk_test_FdWDhqgmFddybwXdk6GOL1fH');
	</script>
	<script src="{{ elixir('js/Checkout.js') }}"></script>
@endsection