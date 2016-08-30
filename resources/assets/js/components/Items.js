import React from 'react';
import ReactDOM from 'react-dom';

import Item from './Item';

class Items extends React.Component
{
	constructor(props)
	{
		super(props);
		this.state = {
			formWasSubmitted: false
		}
	}

	handleSubmit(item) {
		console.log(item)

		// Handle action here

		console.log('Loggin');
	}

	render()
	{
		let items = window.items.map(function(item, index) {
			return (
				<Item 
					key={index} 
					item={item} 
					addToCart={() => this.handleSubmit(item)} />
			)
		}.bind(this));

		return (
			<ul className="Cards">
				{ items }
			</ul>
		)
	}
}

ReactDOM.render(
	<Items />,
	document.getElementById('Items')
);