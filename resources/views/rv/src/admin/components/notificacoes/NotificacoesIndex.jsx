import React from 'react';
import NotificacoesTable from './NotificacoesTable.jsx';
import {Link, Hashrouter as Router} from 'react-router-dom';

class NotificacoesIndex extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		return (<div className="panel panel-default">
					<div className="panel-heading">
						Notificações
						<Link to="/notificacoes/criar" className="btn btn-success pull-right"><em className="fa fa-plus"></em> Criar notificação</Link>
					</div>
					<div className="panel-body">
						<NotificacoesTable/>
					</div>
				</div>);
	}
}

module.exports = NotificacoesIndex;