import React from 'react';
import PlanosTable from './PlanosTable.jsx';
import {HashRouter as Router, Link} from 'react-router-dom';

class PlanosIndex extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		return (<div>
					<div className="row">
						<div className="col-lg-12">
							<h2 className="page-header">Planos</h2>
						</div>
					</div>
					<div className="panel panel-default">
						<div className="panel-heading">
							Planos
							<Link to="/planos/criar" className="btn btn-success pull-right"><em className="fa fa-plus"></em> Criar plano</Link>
						</div>
						<div className="panel-body">
							<PlanosTable/>
						</div>
					</div>
				</div>);
	}
}

module.exports = PlanosIndex;