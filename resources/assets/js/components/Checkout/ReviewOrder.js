import React from 'react';

import ReviewOrderItem from './ReviewOrderItem';

class ReviewOrder extends React.Component
{
	constructor(props)
	{
		super(props);

		this.state = {
			orders: []
		}
	}

	componentDidMount()
	{
		this.setState({
			orders: window.cart
		})
	}

	render()
	{	
		let state = this.state;

		let orders = Object.keys(state.orders).map((item, index) => {
			return (
				<ReviewOrderItem 
					key={index} 
					item={state.orders[item]} />
			)
		});

		return (
			<div className="col-md-4">
				<div className="Subpage__subtitle--container">
					<h3 className="Subpage__subtitle">3. Review Order</h3>
				</div>
				<div className="ReviewCart">
					<table className="table table-bordered">
						<thead>
							<tr>
								<th>Product Name</th>
								<th>Price</th>
								<th>Qty</th>
								<th>Subtotal</th>
							</tr>
						</thead>
						<tbody>
							{ orders }
						</tbody>
						<tfoot>
							<tr>
								<td colSpan="2">
									<h5 className="text-right">Total</h5>
								</td>
								<td colSpan="2">
									<h5>AED {window.subtotal}</h5>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
				
				<div>
					<div className="checkbox">
						<label>
							<input type="checkbox" name="terms" />
							I read &amp; agree the Terms and Conditions.
						</label>
					</div>
				</div>

				<button type="submit" className="btn btn-success btn-lg place-order">
					Place order
				</button>
			</div>
		)
	}
}

export default ReviewOrder;