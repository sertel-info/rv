import React from 'react';
import {Link, HashRouter as Router} from 'react-router-dom';
import FilasTable from './FilasTable.jsx';

class FilasIndex extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		return (
				<div>
					<div className="row">
						<div className="col-lg-12">
							<h2 className="page-header">Filas</h2>
						</div>
					</div>
					<div className="panel panel-default">
						<div className="panel-heading">
							Filas
							<Link to="/filas/criar" className="btn btn-success pull-right"><em className="fa fa-plus"></em> Criar Fila</Link>
						</div>
						<div className="panel-body">
							<FilasTable />
						</div>
					</div>
				</div>);
	}
}

module.exports = FilasIndex;