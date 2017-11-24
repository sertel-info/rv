import React from 'react';
import Axios from 'axios';

class NotifBtn extends React.Component {
	
	constructor(props){
		super(props);

		this.state = {
			loading : true,
			notif_list : []
		}

	}


	componentDidMount(){
		Axios({

			method: "GET",
			url: _ROUTES_.notificacoes.get_new
		
		}).then(function(response){
			
			this.setState({notif_list: response.data.notfs});

		}.bind(this)).catch(function(error){
			
			console.log(error);

		}.bind(this));
	}

	/*
		<li>
			<div className="dropdown-messages-box">
				<a href="profile.html" className="pull-left"></a>
				<div className="message-body"><small className="pull-right">3 mins ago</small>
					<a href="#"><strong>John Doe</strong> commented on <strong>your photo</strong>.</a>
					<br /><small className="text-muted">1:24 pm - 25/03/2015</small>
				</div>
			</div>
		</li>
		<li className="divider"></li>
	*/

	render(){
		let last_five_notifs = this.state.notif_list.map((not, idx) => {
									return <li key={idx}>
												<div className="dropdown-messages-box col-lg-12">
													
													<div className="message-body pull-left col-md-12 pl-0">
														<div className="col-xs-2 col-md-2 pull-left">
															<div className="large">{not.dia}</div>
															<div className="text-muted">{not.mes_ext.substr(0, 3).toUpperCase()}</div>
														</div>
														<div className="col-lg-10 mt-5">
															<a href="#/notificacoes">{not.mensagem_compilada.length > 30 ? not.mensagem_compilada.substr(0,27).concat('...')
																											: not.mensagem_compilada }</a>
															<br /><small className="text-muted">{not.formated_created_at}</small>
														</div>
													</div>
												</div>
											</li>
								});

		let divided_itens = last_five_notifs;
		//adiciona os divisores entre as notificações
		for(let i=1; i< last_five_notifs.length; i++){
			divided_itens.splice(i, 0, <li key={"d".concat(i)}className="divider"></li>);
			i++;
		}

		return (<li className="dropdown">
					<a className="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<em className="fa fa-envelope"></em>
						{this.state.notif_list.length > 0 ? <span className="label label-danger">{this.state.notif_list.length}</span>
														  : null}
					</a>
					<ul className="dropdown-menu dropdown-messages">
						<li style={{overflow:"auto", maxHeight:"300px"}}>
							{divided_itens}
							<li className="divider"></li>
						</li>
						<li>
							<div className="all-button">
								<a href="#/notificacoes">
									<em className="fa fa-inbox"></em> <strong>Ver todas </strong>
								</a>
							</div>
						</li>					
					</ul>
				</li>);
	}
}

module.exports = NotifBtn;