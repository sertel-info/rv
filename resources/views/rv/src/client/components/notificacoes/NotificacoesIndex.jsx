import React from 'react';
import NotificacoesList from './NotificacoesList.jsx';

class NotificacoesIndex extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		return (

				<div>
					<div className="row">
						<div className="col-lg-12">
							<h2 className="page-header">Notificações</h2>
						</div>
					</div>
					<div className="panel panel-default">
							<div className="panel-heading">
								Lista de notificações
							</div>
							<div className="panel-body">
								<NotificacoesList />
							</div>
					</div>
				</div>

				);
	}
}

module.exports = NotificacoesIndex;