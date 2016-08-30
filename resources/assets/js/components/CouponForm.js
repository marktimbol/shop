import React from 'react';

class CouponForm extends React.Component
{
	render()
	{
		return (
			<div>
				<h3>Have coupon?</h3>
				<div className="form-group form-inline">
					<input type="texxt" className="form-control" />
					<button className="btn btn-primary">Apply coupon</button>
				</div>
			</div>
		)
	}
}

export default CouponForm;