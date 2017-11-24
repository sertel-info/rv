import React from 'react';
import {Link, HashRouter as Router} from 'react-router-dom';
import SaudacoesTable from './SaudacoesTable.jsx';

class SaudacoesIndex extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		return (<div>
					<div className="row">
						<div className="col-lg-12">
							<h2 className="page-header">Saudações</h2>
						</div>
					</div>
					<div className="panel panel-default">
						<div className="panel-heading">
							Saudações
							<Link to="/saudacoes/criar" className="btn btn-success pull-right"><em className="fa fa-plus"></em> Criar Saudação</Link>
						</div>
						<div className="panel-body">
							<SaudacoesTable />
						</div>
					</div>
				</div>);
	}
}

module.exports = SaudacoesIndex;