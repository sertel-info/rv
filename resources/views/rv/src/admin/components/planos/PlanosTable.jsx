import React from 'react';
import Table from '../../../general/table/Table.jsx';
import DestroyBtn from '../../../general/DestroyBtn.jsx';
import {Link, HashRouter as Router} from 'react-router-dom';

class PlanosTable extends React.Component {
	
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
							 title : "Descrição",
							 acessor: "descricao"
							},
							{
							 title : "Ações",
							 acessor: "id",
							 render: (data, row) => { 
							 	let btnActions = <div>
							 						<Link to={{pathname:"/planos/editar", params:{p:data}}} className="btn btn-xs btn-primary"> <em className="fa fa-edit fa-2x" aria-hidden="true"/> Editar </Link>							 						
							 						&nbsp;
							 						<DestroyBtn onDelete={this.forceUpdate.bind(this)} href={_ROUTES_.planos.destroy} data_id={data}/>
							 					 </div>;
							 	return btnActions;
							 }}
						      ]

		return (<div>
					<Table 
							id="planos-table"
							class="table table-bordered"
							remote={_ROUTES_.planos.data}
							columns={columns_defs}></Table>
				</div>);
	}
}

module.exports = PlanosTable;