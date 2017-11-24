import React from 'react';
import Axios from 'axios';
import CheckAsReadBtn from './CheckAsReadBtn.jsx';

class NotificacoesList extends React.Component {
	
	constructor(props){
		super(props);

		this.state = {
			loading : true,
			notf_list : []
		}
	}

	componentDidMount(){
		Axios({

			method: "GET",
			url: _ROUTES_.notificacoes.get_list

		}).then(function(response){
			
			this.setState({notf_list : response.data.notfs, loading: false});

		}.bind(this)).catch(function(error){
			
			console.log(error);

		}.bind(this));
	}


	render(){
		if(this.state.loading)
			return <div className="container"><center><img src="img/sertel-loading.gif"/></center></div>
		
		return (<div>
					{
						this.state.notf_list.map((not, idx) =>{
						return <div key={idx} className="article border-bottom">
									<div className="col-xs-12">
										<div className="row">
											<div className="col-xs-2 col-md-2 date">
												<div className="large">{not.dia}</div>
												<div className="text-muted">{not.mes_ext.substr(0, 3).toUpperCase()}</div>
												<div className="text-muted">{not.hora}</div>
											</div>
											<div className="col-xs-8 col-md-8" style={{marginTop:"15px"}}>
												<p >{not.mensagem_compilada}</p>
											</div>
											<div className="col-lg-2" style={{marginTop:"15px"}}>
												{not.vista ? null : <CheckAsReadBtn notf={not.id} is_flash={not.is_flash}/>}
											</div>
										</div>
									</div>
									<div className="clear"></div>
								</div>
					})
					}
				</div>
			   );
	}
}

module.exports = NotificacoesList;