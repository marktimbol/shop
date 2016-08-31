<h3>Filter</h3>
<form method="GET" action="{{ route('shop') }}">
	<h4>Price</h4>
	<p id="price-range"></p>
	<div id="price-slider"></div>

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