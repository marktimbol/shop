@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12 Cart">
				<h2>Shopping Cart</h2>
				<table class="table">
					<thead>
						<tr>
							<th></th>
							<th>Product Name</th>
							<th>Price</th>
							<th>Qty</th>
							<th>Total</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $cart as $item )
						<tr>
							<td width="130">
								<img src="/images/watch_100x132.jpg" 
									alt="{{ $item->name }}" 
									title="{{ $item->name }}" 
									class="img-responsive" />
							</td>
							<td width="400">
								<h3 class="Cart__item">
									<a href="{{ route('items.show', $item->options->item->slug) }}">{{ $item->name }}</a>
								</h3>
							</td>
							<td width="140"><span class="price">AED {{ $item->price }}</span></td>
							<td width="140">
								<input type="text" class="form-control" value="{{ $item->qty }}" size="3" />
							</td>
							<td width="140"><span class="price">AED {{ $item->subtotal }}</span></td>
							<td width="140">&nbsp;</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td colspan="6">
								<h3>Total: AED {{ $subtotal }}</h3>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
@endsection