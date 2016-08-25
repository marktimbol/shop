@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<h2>Sidebar</h2>
			</div>

			<div class="col-md-9">
				<h2>Your Orders</h2>

				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Order ID</th>
							<th>Date Ordered</th>
							<th>Paid</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $orders as $order )
							<tr>
								<td>{{ $order->id }}</td>
								<td>{{ $order->date }}</td>
								<td>{{ $order->paid ? 'Paid' : 'Not paid' }}</td>
								<td>&nbsp;</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection