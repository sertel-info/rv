import React from 'react';
import {Route, Link, HashRouter as Router} from 'react-router-dom';

class BreadCumb extends React.Component {
	
	constructor(props){
		super(props);
	}

	render(){
		let path = this.props.path === undefined ? [] : this.props.path;

		return (<div>

				<div className="row">
					<ol className="breadcrumb">
						<li>
							<a href="#">
								<em className="fa fa-home"></em>
							</a>
						</li>
						{ path.map( (el) => {
							return <li><Link to={el.route}>{el.name}</Link></li>
						} )}
						<li className="active">{this.props.active}</li>
					</ol>
				</div>

				</div>);
	}
}

module.exports = BreadCumb;