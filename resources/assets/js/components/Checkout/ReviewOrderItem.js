import React from 'react';

class ReviewOrderItem extends React.Component
{
	render()
	{
		let item = this.props.item;
		var url = '/items/' + item.options.item.slug;

		return (
			<tr>
				<td width="400">
					<div className="ReviewCart__item-with-image">
						<a href={url}>
							<img src="/images/watch_100x132.jpg" 
								alt={item.name} 
								title={item.name} 
								className="img-responsive"
								width="60" height="80" />
						</a>
						<p>{item.name}</p>
					</div>
				</td>
				<td width="140">
					<span className="price">AED {item.options.item.price}</span>
				</td>
				<td width="140">{item.qty}</td>
				<td width="140"><span className="price">AED {item.subtotal}</span></td>
			</tr>
		)
	}
}

export default ReviewOrderItem;