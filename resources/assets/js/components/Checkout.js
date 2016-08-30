import React from 'react';
import ReactDOM from 'react-dom';

import BillingForm from './BillingForm';
import PaymentMethod from './PaymentMethod';
import CouponForm from './CouponForm';
import ReviewOrder from './ReviewOrder';

class Checkout extends React.Component
{
	render()
	{
		return (
			<div>
				<BillingForm />
				<PaymentMethod>
					<CouponForm />
				</PaymentMethod>
				<ReviewOrder />
			</div>
		)
	}
}

ReactDOM.render(
	<Checkout />,
	document.getElementById('Checkout')
);