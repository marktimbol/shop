import React from 'react';

class BillingForm extends React.Component
{
	render()
	{
		return (
			<div className="col-md-4">
				<div className="Subpage__subtitle--container">
					<h3 className="Subpage__subtitle">1. Billing Information</h3>
				</div>

				{ window.signedIn
					?
					<div className="form-group">
						<label className="control-label" htmlFor="email">Email Address</label>
						<input type="email" 
							id="email" 
							name="email" 
							value={window.user.email}
							className="form-control" />
					</div>
					:
					''
				}

				<div className="form-group">
					<label className="control-label" htmlFor="name">Name</label>
					<input type="text" 
						id="name" 
						name="name" 
						value={window.user.name} 
						className="form-control" />
				</div>

				<div className="form-group">
					<label className="control-label" htmlFor="phone">Phone</label>
					<input type="text" 
						id="phone" 
						name="phone" 
						value={window.user.phone} 
						className="form-control" />
				</div>

				<div className="form-group">
					<label className="control-label" htmlFor="address">Address</label>
					<input type="text" 
						id="address" 
						name="address" 
						value={window.user.address} 
						className="form-control" />
				</div>

				<div className="row">
					<div className="col-md-6 col-xs-6">
						<div className="form-group">
							<label className="control-label" htmlFor="city">City</label>
							<input type="text" 
								id="city" 
								name="city" 
								value={window.user.city} 
								className="form-control" />
						</div>
					</div>

					<div className="col-md-6 col-xs-6">
						<div className="form-group">
							<label className="control-label" htmlFor="state">State/Province</label>
							<input type="text" 
								id="state" 
								name="state" 
								value={window.user.state} 
								className="form-control" />
						</div>
					</div>
				</div>

				<div className="form-group">
					<label className="control-label" htmlFor="country">Country</label>
					<input type="text" 
						name="country" 
						id="country" 
						value={window.user.country} 
						className="form-control" />
				</div>

				{ window.signedIn
					?
						<div>
							<h3>Create your account</h3>
							<div className="form-group">
								<label className="control-label" htmlFor="password">Password</label>
								<input type="password" name="password" className="form-control" />
							</div>

							<div className="form-group">
								<label className="control-label" htmlFor="password">Repeat Password</label>
								<input type="password" name="password_confirmation" className="form-control" />
							</div>
						</div>
					: ''
				}
			</div>
		)
	}
}

export default BillingForm;