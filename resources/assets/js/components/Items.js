import React from 'react';
import ReactDOM from 'react-dom';

import Item from './Item';

class Items extends React.Component
{
	render()
	{
		let items = window.items.map(function(item, index) {
			return (
				<Item item={item} key={index} />
			)
		});

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