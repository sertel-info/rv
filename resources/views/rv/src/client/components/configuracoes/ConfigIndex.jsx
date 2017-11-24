import React from 'react';
import Table from '../../../general/table/Table.jsx';
import {Link, HashRouter as Router } from 'react-router-dom';

class ConfigIndex extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let columns_defs = [
							{
							 title : "Linha",
							 acessor: "nome"
							},
							{
							 title : "Ações",
							 acessor: "id",
							 render: (data) => {
							 	let btnActions = <div>
							 						<Link to={{pathname:"/configuracoes/editar", params:{l:data}}} className="btn btn-xs btn-primary"> <em className="fa fa-cog fa-2x" aria-hidden="true"/> Editar Configurações </Link>
							 					 </div>;
							 	return btnActions;
							 }
							}
							];

		return (<div>
					<div className="row">
						<div className="col-lg-12">
							<h2 className="page-header">Configurações</h2>
						</div>
					</div>
					<div className="panel panel-default">
						<div className="panel-heading">
							Linhas
						</div>
						<div className="panel-body">
							<Table 
								id="config-linhas-table"
								class="table"
								remote={_ROUTES_.linhas.data}
								columns={columns_defs}
							/>
						</div>
					</div>
				</div>);
	}
}

module.exports = ConfigIndex;