import React from 'react';
import AssinantesTable from './AssinantesTable.jsx';
import {HashRouter as Router, Link } from 'react-router-dom';

class AssinantesIndex extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		return (<div>
					<div className="row">
						<div className="col-lg-12">
							<h2 className="page-header">Assinantes</h2>
						</div>
					</div>					
					<div className="panel panel-default">
						<div className="panel-heading">
							Assinantes
							<Link to="/assinantes/criar" className="btn btn-success pull-right"><em className="fa fa-plus"></em> Criar assinante </Link>
						</div>
						<div className="panel-body">
							<AssinantesTable/>
						</div>
					</div>
				</div>);
	}
}

module.exports = AssinantesIndex;