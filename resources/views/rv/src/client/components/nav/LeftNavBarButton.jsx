import React from 'react';
import {Route, Link, HashRouter as Router} from 'react-router-dom';

class LeftNavBarButton extends React.Component {
	
	constructor(props){
		super(props);
		this.props = props;
	}

	render(){
		return (
			<Router>
				<Route exact={true} path={this.props.href} children={({ match }) => (

					<li className={match ? "active" : ""}>
							<Link to={this.props.href}><em className={"fa "+this.props.icon}>&nbsp;</em> {this.props.text}</Link>
					</li>
			    )}/>
			 </Router>
			 );
	}
}

module.exports = LeftNavBarButton;