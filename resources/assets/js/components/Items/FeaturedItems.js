import React from 'react';
import ReactDOM from 'react-dom';
import Item from './Item';

class FeaturedItems extends React.Component
{
	componentDidMount()
	{
		$('.FeaturedItems').owlCarousel({
			items: 5
		});
	}

	render()
	{
		let featuredItems = window.featuredItems.map(function(item, index) {
			return (
				<Item key={index} item={item} hasColumn={false} />
			)
		});

		return (
			<ul className="FeaturedItems Cards">
				{ featuredItems }
			</ul>
		)
	}
}

ReactDOM.render(
	<FeaturedItems />,
	document.getElementById('FeaturedItems')
);