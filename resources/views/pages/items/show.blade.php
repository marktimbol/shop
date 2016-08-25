@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row Item">
			<div class="col-md-4">
				<img src="/images/watch.jpg" 
					alt="{{ $item->name }}" 
					title="{{ $item->name }}" 
					class="img-responsive" />
			</div>
			<div class="col-md-8">
				<h2 class="Item__name">{{ $item->name }}</h2>
				<p class="Item__price">AED {{ $item->price }}</p>

				<hr />

				<p class="Item__description">
					{{ $item->description }}
				</p>

				<form method="POST" action="{{ route('cart.store') }}">
					{{ csrf_field() }}
					<input type="hidden" name="item_id" value="{{ $item->id }}" />
					<div class="form-group form-inline">
						<input type="text" name="quantity" value="1" size="5" class="form-control input-lg text-center" />
						<button class="btn btn-primary btn-lg">Add to cart</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection