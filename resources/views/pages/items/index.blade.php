@extends('layouts.app')

@section('subheader')
	<div class="Subheader">
		<h2>Our Products</h2>
	</div>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<h3>Filter</h3>
				<form method="GET" action="{{ route('shop') }}">
					<h4>Price</h4>
					<h4>Brand</h4>
					@foreach( $brands as $brand )
						<div class="checkbox">
							<label>
								<input type="checkbox" name="brand[]" value="{{ $brand->id }}" />
								{{ $brand->name }}
							</label>
						</div>
					@endforeach

					<button class="btn btn-default">Filter</button>
				</form>
			</div>
			<div class="col-md-9">
				<ul>
					@forelse($items as $item)
						<li>
							<div class="Card col-md-4">
								<div class="Card__info Item--is-new">
									<span>New</span>
								</div>
								<div class="Card__info Item--is-onsale">
									<span>-17%</span>
								</div>
								<div class="Card_image">
									<a href="{{ route('items.show', $item->slug) }}">
										<img src="/images/watch.jpg" 
											alt="{{ $item->name }}" 
											title="{{ $item->name }}" 
											class="img-responsive" />
									</a>
								</div>

								<div class="Card__content">
									<h3 class="Card__title">{{ $item->name }}</h3>
									<div class="Card__price">
										<h4 class="Card__price--new">AED {{ $item->price }}</h4>
										<h5 class="Card__price--old">AED 99</h5>
									</div>
								</div>

								<div class="Card__action">
									<form method="POST" action="{{ route('cart.store') }}">
										{{ csrf_field() }}
										<input type="hidden" name="item_id" value="{{ $item->id }}" />
										<div class="form-group">
											<button class="btn btn-default">Add to cart</button>
										</div>
									</form>
								</div>
							</div>
						</li>
					@empty
						<h5>You don't have any items available</h5>
					@endforelse
				</ul>
			</div>
		</div>
	</div>
@endsection