@extends('layouts.app')

@section('header_styles')
    <link rel="stylesheet" href="{{ elixir('css/home.css') }}" />
@endsection

@section('subheader')
	<div class="Subheader Subheader--item">
		<h2>{{ $item->name }}</h2>
	</div>
@endsection

@section('content')
	<div class="container">
		<div class="row Item">
			<div class="col-md-4">
				<div class="Item__images--container">
					<div class="Item__images--main">
						<img src="/images/watch.jpg" 
							alt="{{ $item->name }}" 
							title="{{ $item->name }}" 
							class="img-responsive" />
					</div>
					<div class="Item__thumbnails">
						@foreach( range(1, 4) as $index )
						<div class="Item__thumbnail">
							<img src="/images/watch.jpg" 
								alt="{{ $item->name }}" 
								title="{{ $item->name }}" 
								class="img-responsive"
								width="78" height="103" />
						</div>
						@endforeach
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<h2 class="Item__name">{{ $item->name }}</h2>
				<div class="Item__price--container">
					<p class="Item__price--old">AED 99</p>
					<p class="Item__price--new">AED {{ $item->price }}</p>
				</div>

				<div class="Item__availability">
					<p class="Item__availability--stocks-left">
						<i class="fa fa-database"></i> Only {{ $item->quantity }} left
					</p>
					<p class="Item__availability--status">
						<strong>Availability:</strong> 
						@if( $item->quantity > 0 )
							<span class="Item--is-available">In Stock</span>
						@else
							<span class="Item--is-not-available">No Stock</span>
						@endif
					</p>
				</div>	

				<hr />

				<p class="Item__description">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>

				<form method="POST" action="{{ route('cart.store') }}">
					{{ csrf_field() }}
					<input type="hidden" name="item_id" value="{{ $item->id }}" />
					<div class="form-group form-inline">
						<input type="text" name="quantity" value="1" size="5" class="form-control input-lg text-center" />
						<button class="btn btn-default btn-lg">Add to cart</button>
					</div>
				</form>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="Subpage__subtitle--container">
					<h3 class="Subpage__subtitle">You might also be interested in</h3>
				</div>
				<div class="row">
					<ul id="FeaturedItems" class="RelatedItems Cards">
						@foreach($relatedItems as $item)
							<li>
								<div class="Card">
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
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('footer_scripts')
    <script src="{{ elixir('js/home.js') }}"></script>
@endsection