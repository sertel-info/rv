import React from 'react';
import GruposTable from './GruposTable.jsx';
import {Link, HashRouter} from 'react-router-dom';

class GruposIndex extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		return (<div>
					<div className="row">
						<div className="col-lg-12">
							<h2 className="page-header">Grupos de Atendimento</h2>
						</div>
					</div>
					<div className="panel panel-default">
						<div className="panel-heading">
							Grupos
							<Link to="/grupos/criar" className="btn btn-success pull-right"><em className="fa fa-plus"></em> Criar grupo </Link>
						</div>
						<div className="panel-body">
							<GruposTable/>
						</div>
					</div>

				</div>);
	}
}

module.exports = GruposIndex;