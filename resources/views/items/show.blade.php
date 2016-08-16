@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>{{ $item->name }}</h2>
				<form method="POST" action="{{ route('cart.store') }}">
					{{ csrf_field() }}
					<input type="hidden" name="item_id" value="{{ $item->id }}" />
					<div class="form-group">
						<button class="btn btn-default">Add to cart</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection