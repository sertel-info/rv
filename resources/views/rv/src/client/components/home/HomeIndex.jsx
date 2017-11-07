import React from 'react';
import PeerStatusList from './PeerStatusList.jsx';
import QueuesStatusList from './QueuesStatusList.jsx';

class HomeIndex extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		return (<div>
					<div className="row">
						<div className="col-lg-12">
							<h2 className="page-header">Início</h2>
						</div>
					
					</div>
					<div className="col-lg-6">
						<PeerStatusList />
					</div>
					<div className="col-lg-6">
						<QueuesStatusList />
					</div>
				</div>);
	}
}

module.exports = HomeIndex;