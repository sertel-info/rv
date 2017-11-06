import React from 'react';

class BreadCumb extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		return (<div>

				<div className="row">
					<ol className="breadcrumb">
						<li><a href="#">
							<em className="fa fa-home"></em>
						</a></li>
						<li className="active">Dashboard</li>
					</ol>
				</div>

				</div>);
	}
}

module.exports = BreadCumb;