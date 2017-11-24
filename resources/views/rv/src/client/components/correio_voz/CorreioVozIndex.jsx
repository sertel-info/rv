import React from 'react';
import CorreioVozTable from './CorreioVozTable.jsx';

class CorreioVozIndex extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		return (<div>
					<div className="row">
						<div className="col-lg-12">
							<h2 className="page-header">Correio de voz</h2>
						</div>
					</div>
					<div className="panel panel-default">
						<div className="panel-heading">
						</div>
						<div className="panel-body">
							<CorreioVozTable />
						</div>
					</div>
				</div>);
	}
}

module.exports = CorreioVozIndex;