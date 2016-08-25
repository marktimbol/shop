@extends('layouts.app')

@section('content')
	<h2>Order details</h2>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Product Name</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Subtotal</th>
			</tr>
		</thead>
		<tbody>
			<?php $total = 0; ?>
			@foreach( $order->details as $detail )
				<?php $total += $detail->subtotal; ?>
				<tr>
					<td>{{ $detail->item->name }}</td>
					<td>{{ $detail->quantity }}</td>
					<td>AED {{ $detail->item->price }}</td>
					<td>AED {{ $detail->subtotal }}</td>
					<td>&nbsp;</td>
				</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td colspan="5">Total: AED {{ $total }}</td>
			</tr>
		</tfoot>
	</table>
@endsection