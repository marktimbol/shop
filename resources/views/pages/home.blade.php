@extends('layouts.app')

@section('content')
	<ul>
		@foreach($items as $item)
			<li>
				<div class="Item col-md-3">
{{-- 					<div class="Item__info Item--new">
						<span>New</span>
					</div>
					<div class="Item__info Item--onsale">
						<span>-17%</span>
					</div> --}}
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
			</li>
		@endforeach
	</ul>
@endsection