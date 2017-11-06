import React from 'react';
import Table from '../../../general/table/Table.jsx';
import {Link, HashRouter as Router} from 'react-router-dom';
import DestroyBtn from '../../../general/DestroyBtn.jsx';

class GruposTable extends React.Component {
	
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
							 acessor: "tipo"
							},
							{
							 title : "Linhas",
							 acessor : "nome_linhas"
							},
							{
							 title : "Ações",
							 acessor : "id",
							 render: (data, row) => { 
							 	let btnActions = <div>
							 						<Link to={{pathname:"/grupos/editar", params:{grupo:data}}} className="btn btn-xs btn-primary"> <em className="fa fa-edit fa-2x" aria-hidden="true"/> Editar </Link>
							 						&nbsp;
							 						<DestroyBtn onDelete={this.forceUpdate.bind(this)} href={_ROUTES_.grupos.destroy} data_id={data}/>
							 					 </div>;
							 	return btnActions;
							 }
							}
						    ]

		return (<div>
					<Table 
							id="grupos-table"
							class="table table-bordered"
							remote={_ROUTES_.grupos.data}
							columns={columns_defs}></Table>
				</div>);

	}
}

module.exports = GruposTable;