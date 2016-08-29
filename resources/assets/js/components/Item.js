import React from 'react';

class Item extends React.Component
{
	render()
	{
		let item = this.props.item;
		const url = '/items/' + item.slug;

		return (
    		<li>
    			<div className="Card col-md-4">
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
                            { item.price < item.old_price  ?
    							<h5 className="Card__price--old">AED { item.old_price }</h5>
                            : '' }
    					</div>
    				</div>

    				<div className="Card__action">
    					<form method="POST" action="/cart">
    						<input type="hidden" name="item_id" value={item.id} />
    						<div className="form-group">
    							<button className="btn btn-default">Add to cart</button>
    						</div>
    					</form>
    				</div>
    			</div>
    		</li>
		)
	}
}

export default Item;