@extends('layouts.app')

@section('subheader')
	<div class="Subheader">
		<h2>Order details</h2>
	</div>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				@include('dashboard._sidebar')
			</div>

			<div class="col-md-9">
				<h2>Order ID: {{ $order->id }}</h2>

				<table class="table table-bordered">
					<thead>
						<tr>
							<th></th>
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
								<td>
									<img src="/images/watch_100x132.jpg" 
										alt="{{ $detail->item->name }}" 
										title="{{ $detail->item->name }}" 
										class="img-responsive" />
								</td>
								<td>{{ $detail->item->name }}</td>
								<td>{{ $detail->quantity }}</td>
								<td>AED {{ $detail->item->price }}</td>
								<td>AED {{ $detail->subtotal }}</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td colspan="5">
								<h3 class="text-right">Total: AED {{ $total }}</h3>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
@endsection