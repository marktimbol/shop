import React from 'react';
import ReactDOM from 'react-dom';
import RelatedItems from './RelatedItems';

const csrf_token = $('meta[name="csrf_token"]').attr('content');

class ShowItem extends React.Component
{
	constructor(props) {
		super(props);

		this.state = {
			formWasSubmitted: false,
			quantity: 1,
		}
	}

	handleSubmit(e) {
		e.preventDefault();

		this.setState({
			formWasSubmitted: true
		});

		this.addToCart();
	}

    addToCart() {
        $.ajax({
            url: '/cart',
            method: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-Token': csrf_token
            },
            data: {
                item_id: window.item.id,
                quantity: this.state.quantity,
            },
            success: function(result) {
                this.setState({ formWasSubmitted: false });
                swal({
                    title: "Shop",  
                    text: "Item was added on the cart.",  
                     type: "success", 
                     showConfirmButton: true,
                     confirmButtonText: 'Okay'
                });
            }.bind(this),
            error: function(xhr, status, err) {
                swal({
                    title: 'Shop',  
                    text: 'A problem was encountered while adding the item in your cart. Please try again.',
                    type: 'error', 
                    showConfirmButton: true,
                    confirmButtonText: 'Okay'
                });
            }.bind(this)
        })
    }

	render()
	{
		let item = window.item;

		return (
			<div>
				<div className="row Item">
					<div className="col-md-4">
						<div className="Item__images--container">
							<div className="Item__images--main">
								<img src="/images/watch.jpg" 
									alt={item.name} 
									title={item.name} 
									className="img-responsive" />
							</div>
							<div className="Item__thumbnails">
								<div className="Item__thumbnail">
									<img src="/images/watch.jpg" 
										alt={item.name} 
										title={item.name} 
										className="img-responsive"
										width="78" height="103" />
								</div>
							</div>
						</div>
					</div>
					<div className="col-md-8">
						<h2 className="Item__name">{item.name}</h2>
						<div className="Item__price--container">
							{ item.price < item.old_price ?
								<p className="Item__price--old">AED {item.old_price}</p>
								:
								<p className="Item__price--new">AED {item.price}</p>
							}
						</div>

						<div className="Item__availability">
							<p className="Item__availability--stocks-left">
								<i className="fa fa-database"></i> Only {item.quantity} left
							</p>
							<p className="Item__availability--status">
								<strong>Availability:</strong>&nbsp;
								{ item.quantity > 0 ?
									<span className="Item--is-available">In Stock</span>
									:
									<span className="Item--is-not-available">No Stock</span>
								}
							</p>
						</div>	

						<hr />

						<p className="Item__description">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</p>

						<form method='POST' onSubmit={this.handleSubmit.bind(this)}>
							<input type="hidden" name="item_id" value={item.id} />
							<div className="row">
								<div className="col-md-3 col-xs-6">
									<div className="input-group">
										<span className="input-group-btn">
											<button type="button" className="btn btn-lg btn-default">-</button>
										</span>
										<input type="text" 
											value="1" 
											size="5" 
											value={this.state.quantity}
											className="form-control input-lg text-center"
											onChange={(e) => this.setState({ quantity: e.target.value })} />
										<span className="input-group-btn">
											<button type="button" className="btn btn-lg btn-default">+</button>
										</span>
									</div>
								</div>
								<div className="col-md-3 col-xs-6">
				                    {
				                        this.state.formWasSubmitted ?
											<button className="btn btn-lg btn-default" disabled>
				                                <i className="fa fa-spin fa-spinner"></i> Adding to cart
				                            </button>
				                        :
				                            <button className="btn btn-lg btn-default">
				                                Add to cart
				                            </button>
				                    }
								</div>
							</div>
						</form>
					</div>
				</div>

				<div className="row">
					<div className="col-md-12">
						<div className="Subpage__subtitle--container">
							<h3 className="Subpage__subtitle">You might also be interested in</h3>
						</div>
						<div className="row">
							<RelatedItems relatedItems={window.relatedItems} />
						</div>
					</div>
				</div>
			</div>
		)
	}
}

ReactDOM.render(
	<ShowItem />,
	document.getElementById('ShowItem')
);

