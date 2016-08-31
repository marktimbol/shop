import React from 'react';

import CreditCardForm from './CreditCardForm';

class PaymentMethod extends React.Component
{
	constructor(props)
	{
		super(props);
		this.state = {
			payment: 'cash'
		}
	}

	render()
	{
		return (
			<div className="col-md-4">
				<div className="Subpage__subtitle--container">
					<h3 className="Subpage__subtitle">2. Payment Method</h3>
				</div>

				<div className="radio">
					<label>
						<input type="radio" 
							name="payment" 
							value="cash"
							onClick={() => this.setState({ payment: 'cash'})}
							defaultChecked /> Cash on delivery
					</label>
				</div>

				<div className="radio">
					<label>
						<input type="radio" 
							name="payment" 
							onClick={() => this.setState({ payment: 'card'})}
							value="card" /> Credit Card
					</label>
				</div>

				{ this.state.payment == 'card' ? <CreditCardForm /> : '' }

				{ this.props.children }
			</div>
		)
	}
}

export default PaymentMethod;