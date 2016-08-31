@extends('layouts.app')

@section('header_styles')
	<link rel="stylesheet" href="{{ elixir('css/price-slider.css') }}" />
@endsection

@section('subheader')
	<div class="Subheader">
		<h2>Our Products</h2>
	</div>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3 ShopFilters">
				@include('pages.items._filters')
			</div>
			<div class="col-md-9">
				<div id="Items"></div>
{{-- 				<ul>
					@forelse($items as $item)
						<li>
							<div class="Card col-md-4">
		                        @if( $item->isNew())
		            				<div class="Card__info Item--is-new">
		            					<span>New</span>
		            				</div>
		                        @endif
		                        @if( $item->isOnSale() )
		            				<div class="Card__info Item--is-onsale">
		            					<span>{{ $item->getDiscountPercentage() }}%</span>
		            				</div>
		                        @endif
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
				                        @if( $item->price < $item->old_price )
										  <h5 class="Card__price--old">AED {{ $item->old_price }}</h5>
				                        @endif
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
				</ul> --}}
			</div>
		</div>
	</div>
@endsection

@section('footer_scripts')
	<script src="{{ elixir('js/price-slider.js') }}"></script>
	<script src="{{ elixir('js/Items.js') }}"></script>
@endsection