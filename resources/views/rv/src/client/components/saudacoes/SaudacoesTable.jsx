import React from 'react';
import Table from '../../../general/table/Table.jsx';
import {Link, HashRouter as Router} from 'react-router-dom';
import DestroyBtn from '../../../general/DestroyBtn.jsx';

class SaudacoesTable extends React.Component {
	
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
							 acessor: "tipo_audio"
							},
							{
							 title : "Ações",
							 acessor : "id",
							 render : (data,row) => {
							 	let btnActions = <div>
							 						<Link to={{pathname:"/saudacoes/editar", params:{s:data}}} className="btn btn-xs btn-primary"> <em className="fa fa-edit fa-2x" aria-hidden="true"/> Editar </Link>
							 						&nbsp;
							 						<DestroyBtn onDelete={this.forceUpdate.bind(this)} href={_ROUTES_.saudacoes.destroy} data_id={data}/>
							 					 </div>;
							 	return btnActions;
							 }
							}
						    ]

		return (<div>
					<Table 
							id="saudacoes-table"
							class="table table-bordered"
							remote={_ROUTES_.saudacoes.data}
							columns={columns_defs}/>
				</div>);
	}
}

module.exports = SaudacoesTable;