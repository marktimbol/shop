@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Shopping Cart</h2>

				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Total</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $cart as $item )
						<tr>
							<td>{{ $item->name }}</td>
							<td>{{ $item->qty }}</td>
							<td>AED {{ $item->price }}</td>
							<td>AED {{ $item->subtotal }}</td>
							<td>&nbsp;</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td colspan="5">
								<h3>Total: AED {{ $subtotal }}</h3>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
@endsection