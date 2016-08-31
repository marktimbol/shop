import React from 'react';

class CreditCardForm extends React.Component
{
	render()
	{
		let minYear = new Date().getFullYear();
    	let yearsArray = [];

		for( let i = minYear; i <= minYear + 10; i++ ) {
			yearsArray.push(i);
		}

		let yearOptions = yearsArray.map((year) => {
			return (
				<option key={year} value={year}>{year}</option>
			);
		});

		return (
			<div>
				<h3>Credit Card</h3>
				<div className="form-group">
					<label className="control-label" htmlFor="card_number">Name on Card</label>
					<input type="text" 
						id="card_name" 
						data-stripe="name" 
						value="Mark Timbol"
						className="form-control" />
				</div>

				<div className="form-group">
					<label className="control-label" htmlFor="card_number">Card Number</label>
					<input type="text" 
						id="card_number" 
						size="20" 
						data-stripe="number" 
						value="4242424242424242"
						className="form-control" />
				</div>

				<div className="row">
					<div className="col-md-8">
						<div className="row">
							<div className="col-md-12">
								<label className="control-label" htmlFor="card_expiry_month">Expiry (MM/YYYY)</label>
									<div className="form-group form-inline">
										<select 
											data-stripe="exp-month" 
											className="form-control" 
											onChange={() => console.log('expMonth') }
										>
							            	<option value="1">01 - January</option>
							            	<option value="2">02 - February</option>
							            	<option value="3">03 - March</option>
							            	<option value="4">04 - April</option>
							            	<option value="5">05 - May</option>
							            	<option value="6">06 - June</option>
							            	<option value="7">07 - July</option>
							            	<option value="8">08 - August</option>
							            	<option value="9">09 - September</option>
							            	<option value="10">10 - October</option>
							            	<option value="11">11 - November</option>
							            	<option value="12">12 - December</option>
										</select>

										<select 
											data-stripe="exp-year" 
											className="form-control" 
											onChange={() => console.log('expYear')}
										>
											{yearOptions}
										</select>
									</div>
							</div>
						</div>
					</div>

					<div className="col-md-4">
						<div className="form-group">
							<label className="control-label" htmlFor="card_cvc">CVC</label>
							<input type="text" 
								id="card_cvc"
								size="4" 
								data-stripe="cvc" 
								value="123"
								className="form-control" />
						</div>
					</div>
				</div>
			</div>
		)
	}
}

export default CreditCardForm;