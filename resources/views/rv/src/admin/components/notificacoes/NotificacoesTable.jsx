import React from 'react';
import Axios from 'axios';
import Table from '../../../general/table/Table.jsx';
import DestroyBtn from '../../../general/DestroyBtn.jsx';
import {Link, HashRouter as Router} from 'react-router-dom';

class NotificacoesTable extends React.Component {
	
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
							 title : "Mensagem",
							 acessor: "mensagem"
							},
							{
							 title : "Título",
							 acessor: "titulo"
							},
							{
							 title : "Evento",
							 acessor: "escutar_evento"
							},
							{
							 title : "Ações",
							 acessor: "id",
							 render: (data, row) => { 
							 	let btnActions = <div>
							 						<Link to={{pathname:"/notificacoes/editar", params:{notificacao:data}}} className="btn btn-xs btn-primary"> <em className="fa fa-edit fa-2x" aria-hidden="true"/> Editar </Link>
							 						&nbsp;
							 						<DestroyBtn onDelete={this.forceUpdate.bind(this)} href={_ROUTES_.notificacoes.destroy} data_id={data}/>
							 					 </div>;
							 	return btnActions;
							 }}
						      ]

		return (<div>
					<Table 
							id="notificacoes-table"
							class="table table-bordered"
							remote={_ROUTES_.notificacoes.data}
							columns={columns_defs}></Table>
				</div>);
	}
}

module.exports = NotificacoesTable;