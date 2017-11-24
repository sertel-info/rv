import React from 'react';
import {Link, HashRouter as Router} from 'react-router-dom';
import DestroyBtn from '../../../general/DestroyBtn.jsx';
import Table from '../../../general/table/Table.jsx';

class FilasTable extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let columns_defs = [
							{
							 title : "Nome",
							 acessor: "nome"
							},
							{
							 title : "Tipo",
							 acessor: "tipo",
							 render : (data) => {
							 	return data.charAt(0).toUpperCase() + data.slice(1);
							 }
							},
							{
							 title : "Linhas",
							 acessor: "nome_linhas"
							},
							{
							 title : "Ações",
							 acessor : "id",
							 render : (data,row) => {
							 	let btnActions = <div>
							 						<Link to={{pathname:"/filas/editar", params:{fila:data}}} className="btn btn-xs btn-primary"> <em className="fa fa-edit fa-2x" aria-hidden="true"/> Editar </Link>
							 						&nbsp;
							 						<DestroyBtn onDelete={this.forceUpdate.bind(this)} href={_ROUTES_.filas.destroy} data_id={data}/>
							 					 </div>;
							 	return btnActions;
							 }
							}
						    ];

		return (<div>
					<Table 
							id="filas-table"
							class="table table-bordered"
							remote={_ROUTES_.filas.data}
							columns={columns_defs}/>
				</div>);
	}
}

module.exports = FilasTable;