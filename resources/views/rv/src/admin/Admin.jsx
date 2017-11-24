import React from 'react';
import TopNavBar from './components/nav/TopNavBar.jsx';
import LeftNavBar from './components/nav/LeftNavBar.jsx';
import BreadCumb from './components/nav/BreadCumb.jsx';
import ContentRouter from './components/router/ContentRouter.jsx';
import BreadcumbRouter from './components/router/BreadcumbRouter.jsx';

class Admin extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		return (<div>
					<TopNavBar/>
					<LeftNavBar/>
					<div className="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
						<BreadcumbRouter/>
						<div className="container-fluid">
							<ContentRouter/>
						</div>
					</div>
				</div>);
	}
}

module.exports = Admin;