import React from 'react';
import Axios from 'axios';
import Table from '../../../general/table/Table.jsx';
import DestroyBtn from '../../../general/DestroyBtn.jsx';
import {HashRouter, Link} from 'react-router-dom';
import LogarBtn from './table_btns/LogarBtn.jsx';
import NotificacoesBtn from './table_btns/NotificacoesBtn.jsx';

class AssinantesTable extends React.Component {
	
	constructor(props){
		super(props);
	}


	render(){
		let columns_defs = [
							{
							 title : "Nome",
							 acessor: "nome_completo"
							},
							{
							 title : "Tipo",
							 acessor: "tipo"
							},
							{
							 title : "Plano",
							 acessor: "planos.nome"
							},
							{
							 title : "Ações",
							 acessor: "id",
							 render: (data, row) => {
							 	
							 	let btnActions = <div>
							 						<div className="pull-left ml-2"><Link to={{pathname:"/assinantes/editar", params:{assinante:data}}} className="btn btn-xs btn-primary"> <em className="fa fa-edit fa-2x" aria-hidden="true"/> Editar </Link></div>
							 						&nbsp;
							 						<div className="pull-left ml-2"><LogarBtn user={row.acesso.id} /> </div>
							 						&nbsp;
							 						<div className="pull-left ml-2"><Link to={{pathname:"/assinantes/notificacoes/criar", params:{assinante:data}}} className="btn btn-xs btn-primary"> <em className="fa fa-edit fa-2x" aria-hidden="true"/> Notificações </Link></div>
							 						&nbsp;
							 						<div className="pull-left ml-2"><Link to={{pathname:"/assinantes/creditos", params:{assinante:data}}} className="btn btn-xs btn-primary"> <em className="fa fa-dollar fa-2x" aria-hidden="true"/> Créditos </Link> </div>
							 						&nbsp;
							 						<div className="pull-left ml-2"><DestroyBtn onDelete={this.forceUpdate.bind(this)} href={_ROUTES_.assinantes.destroy} data_id={data}/></div>
							 					 </div>;
							 	
							 	return btnActions;
							 }}
						    ]

		return (<div>
					<Table 
							id="assinantes-table"
							class="table table-bordered"
							remote={_ROUTES_.assinantes.data}
							columns={columns_defs}></Table>
				</div>);
	}
}

module.exports = AssinantesTable;