@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2">
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
			<div class="col-md-10">
				<ul>
					@foreach($items as $item)
						<li>
							<div class="col-md-4">
								<div class="Item">
									<div class="Item__info Item--new">
										<span>New</span>
									</div>
									<div class="Item__info Item--onsale">
										<span>-17%</span>
									</div>
									<div class="Item__image">
										<a href="{{ route('items.show', $item->slug) }}">
											<img src="/images/watch.jpg" 
												alt="{{ $item->name }}" 
												title="{{ $item->name }}" 
												class="img-responsive" />
										</a>
									</div>

									<div class="Item__content">
										<h3 class="Item__name">{{ $item->name }}</h3>
										<div class="Item__price">
											<h4 class="Item__price--new">AED {{ $item->price }}</h4>
											<h5 class="Item__price--old">AED 99</h5>
										</div>
									</div>

									<div class="Item__action">
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
						</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
@endsection