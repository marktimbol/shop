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
			<div>
				<div className="container">
		            <div className="row">
		                <div className="col-md-12">
		                    <div className="Subpage__subtitle--container">
		                        <h2 className="Subpage__subtitle">Featured products</h2>
		                        <p className="Subpage__subtitle--small">We showcase things what you need</p>
		                    </div>
		                </div>
		            </div>
				</div>
				<ul className="FeaturedItems Cards">
					{ featuredItems }
				</ul>
			</div>
		)
	}
}

ReactDOM.render(
	<FeaturedItems />,
	document.getElementById('FeaturedItems')
);