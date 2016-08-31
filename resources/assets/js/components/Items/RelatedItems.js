import React from 'react';

import Item from './Item';

class RelatedItems extends React.Component
{
	componentDidMount()
	{
		$('.RelatedItems').owlCarousel({
			items: 5
		});
	}

	render()
	{
		let relatedItems = this.props.relatedItems.map(function(item, index) {
			return (
				<Item key={index} item={item} hasColumn={false} />
			)
		});

		return (
			<ul className="RelatedItems Cards">
				{ relatedItems }
			</ul>
		)
	}
}

export default RelatedItems;