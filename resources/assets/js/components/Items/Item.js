import React from 'react';
import classNames from 'classnames';

const csrf_token = $('meta[name="csrf_token"]').attr('content');

class Item extends React.Component
{
    constructor(props)
    {
        super(props);

        this.state = {
            formWasSubmitted: false
        }
    }

    handleSubmit(e) {
        e.preventDefault();
        this.setState({ formWasSubmitted: true });
        
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
                item_id: this.props.item.id,
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

    isNew()
    {
        let item = this.props.item;
        let today = new Date();
        let updated_at = new Date(item.updated_at);

        let timeDifference = Math.abs(updated_at.getTime() - today.getTime());
        let dayDifference = Math.ceil(timeDifference / (1000 * 3600 * 24)); 

        return dayDifference < 7 ? true : false;
    }

    onSale()
    {
        let item = this.props.item;
        return item.price < item.old_price;
    }

    getDiscountPercentage()
    {
        let item = this.props.item;
        let percentage = (item.old_price - item.price) / item.old_price;

        return -Math.round(percentage * 100);
    }

	render()
	{
		let item = this.props.item;
        let CardClass = classNames({
            'Card': true,
            'col-md-4': this.props.hasColumn
        });
        const url = '/items/' + item.slug;

		return (
    		<li>
    			<div className={CardClass}>
                    { this.isNew() ?
                        <div className="Card__info Item--is-new">
                            <span>New</span>
                        </div>
                        : ''
                    }
                    { this.onSale() ? 
                        <div className="Card__info Item--is-onsale">
                            <span>{this.getDiscountPercentage()}%</span>
                        </div>
                        : ''
                    }
    				<div className="Card_image">
    					<a href={url}>
    						<img src="/images/watch.jpg" 
    							alt={item.name}
    							title={item.name}
    							className="img-responsive" />
    					</a>
    				</div>

    				<div className="Card__content">
    					<h3 className="Card__title">{item.name}</h3>
    					<div className="Card__price">
    						<h4 className="Card__price--new">AED {item.price}</h4>
                            { this.state.formWasSubmitted }
                            { item.price < item.old_price  ?
    							<h5 className="Card__price--old">AED { item.old_price }</h5>
                            : '' }
    					</div>
    				</div>

    				<div className="Card__action">
                        <form method="POST" onSubmit={this.handleSubmit.bind(this)}>
    						<div className="form-group">
                                {
                                    this.state.formWasSubmitted ?
            							<button className="btn btn-default" disabled>
                                            <i className="fa fa-spin fa-spinner"></i> Adding to cart
                                        </button>
                                    :
                                        <button className="btn btn-default">
                                            Add to cart
                                        </button>
                                }
    						</div>
                        </form>
    				</div>
    			</div>
    		</li>
		)
	}
}

export default Item;