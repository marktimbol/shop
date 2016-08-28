@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				@include('dashboard._sidebar')
			</div>

			<div class="col-md-9">
				<h2>My Orders</h2>

				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Order ID</th>
							<th>Name</th>
							<th>Date Ordered</th>
							<th>Paid</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $orders as $order )
							<tr>
								<td><a href="{{ route('dashboard.orders.show', $order->id) }}">{{ $order->id }}</a></td>
								<td>{{ $order->user->name }}</td>
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