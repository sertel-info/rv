import React from 'react';
import Axios from 'axios';

class HomeIndex extends React.Component {
	
	constructor(props){
		super(props);

		this.state = {
			assinantes_num : 0,
			linhas_num : 0,
			ligacoes_hoje : 0,
			ligacoes_semana : 0
		}
	}

	componentDidMount(){
		$(".stat-container .stat").hide();
		$(".stat-container").append($('<img class="loading-sm" src="/img/sertel-loading.gif"/>'));
		
		Axios({

			method: "GET",
			url: _ROUTES_.dashboard.stats

		}).then(function(response){
			let data = response.data;
			
			this.setState({
				assinantes_num : data.assinantes,
				linhas_num: data.linhas,
				ligacoes_hoje: data.lig_hoje,
				ligacoes_semana: data.lig_semana
			});

			$(".stat-container .stat").show();
			$(".stat-container img").remove();

		}.bind(this)).catch(function(error){
			
			console.log(error);
		}.bind(this));
	}

	render(){
		return <div>
					
					    <div className="row">
							<div className="col-lg-12">
								<h1 className="page-header">Início</h1>
							</div>
						</div>
						<div className="panel panel-container">
							<div className="row">
								<div className="col-xs-6 col-md-3 col-lg-3 no-padding">
									<div className="panel panel-teal panel-widget border-right">
										<div className="row no-padding"><em className="fa fa-xl fa-user color-blue"></em>
											<div className="large stat-container" id="ass_num_container">
												<div className="stat">{this.state.assinantes_num}</div>
											</div>
											<div className="text-muted">Assinantes</div>
										</div>
									</div>
								</div>
								<div className="col-xs-6 col-md-3 col-lg-3 no-padding">
									<div className="panel panel-blue panel-widget border-right">
										<div className="row no-padding"><em className="fa fa-xl fa-phone color-orange"></em>
											<div className="large stat-container" id="lin_num_container">
												<div className="stat">{this.state.linhas_num}</div>
											</div>
											<div className="text-muted">Linhas</div>
										</div>
									</div>
								</div>
								<div className="col-xs-6 col-md-3 col-lg-3 no-padding">
									<div className="panel panel-orange panel-widget border-right">
										<div className="row no-padding"><em className="fa fa-xl fa-exchange  color-teal"></em>
											<div className="large stat-container" id="lig_h_container">
												<div className="stat"> {this.state.ligacoes_hoje}</div>
											</div>
											<div className="text-muted">Ligações Hoje</div>
										</div>
									</div>
								</div>
								<div className="col-xs-6 col-md-3 col-lg-3 no-padding">
									<div className="panel panel-red panel-widget ">
										<div className="row no-padding"><em className="fa fa-xl fa-exchange  color-red"></em>
											<div className="large stat-container" id="lig_s_container">
												<div className="stat">{this.state.ligacoes_semana}</div>
											</div>
											<div className="text-muted">Ligações essa semana</div>
										</div>
									</div>
								</div>
							</div>
						</div>
			   </div>;
	}  
}

module.exports = HomeIndex;