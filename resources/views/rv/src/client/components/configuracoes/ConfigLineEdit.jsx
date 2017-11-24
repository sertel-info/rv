import React from 'react';
import FormInterface from '../../../general/FormInterface.jsx';
import Axios from 'axios';
import ConfigForm from './ConfigForm.jsx';

class ConfigLineEdit extends FormInterface {
	
	constructor(props){
		super(props);

		this.route = _ROUTES_.configuracoes.update_linha;

		this.success_message = <div className="alert">
									<h2 className="text-success"><i className="fa fa-check"/>&nbsp;Configurações atualizadas com successo !</h2>
							   </div>;

		try{
			this.params = {"l": this.props.location.params.l};
		} catch (e){
			window.location = "#/configuracoes";
		}

		this.onSuccess = () => {
			window.location = "#/configuracoes";
		}

		this.state = {
			permissions : {
							cadeado_pessoal:0,
							caixa_postal:0,
							siga_me	: 0,
							at_automatico:0,
							saudacoes:0
						  },
			loading: true,
			
			cadeado_pessoal:0,
			cadeado_pin: "",
			siga_me : 0,
			num_siga_me : "",
			caixa_postal : 0,
			cx_postal_email : "",
			cx_postal_pw : "",
			at_automatico : 0,
			at_automatico_dest : 0
			
		}

		this.getPermissions = this.getPermissions.bind(this);
		this.getRemoteData = this.getRemoteData.bind(this);
	}


	getRemoteData(){
		Axios({
			
			method: "GET",
			url: _ROUTES_.configuracoes.get_linha_conf_data,
			params: {l: this.params.l}

		}).then(function(response){
			let data = response.data.conf;

			let at_auto_dest = 0;
			
			switch(data.atend_automatico_tipo){
				case "grupo":
					at_auto_dest = "g".concat('_',data.atend_automatico_destino);
				break;
				case "fila":
					at_auto_dest = "f".concat('_',data.atend_automatico_destino);
				break;
				case "ura":
					at_auto_dest = "u".concat('_',data.atend_automatico_destino);
				break;
			}

			this.setState({
				cadeado_pessoal:data.cadeado_pessoal,
				cadeado_pin: data.cadeado_pin,
				siga_me : data.siga_me,
				num_siga_me : data.num_siga_me == null ? "" : data.num_siga_me,
				caixa_postal : data.caixa_postal,
				cx_postal_email : data.cx_postal_email == null ? "" : data.cx_postal_email,
				cx_postal_pw : data.cx_postal_pw == null ? "" : data.cx_postal_pw,
				at_automatico : data.atend_automatico,
				at_automatico_dest : at_auto_dest,
				loading: false
			});

		}.bind(this)).catch(function(error){
			
			console.log(error);

		}.bind(this));	
	}

	getPermissions(){
		Axios({
			
			method: "GET",
			url: _ROUTES_.configuracoes.get_perm_linha,
			params : {l: this.params.l}

		}).then(function(response){
			
			this.setState({
				permissions : {
					cadeado_pessoal:response.data.cadeado,
					caixa_postal:response.data.caixa_postal,
					siga_me	: response.data.siga_me,
					at_automatico: response.data.atendimento_automatico,
					saudacoes:response.data.saudacoes
				}
			
			}, this.getRemoteData);

		}.bind(this)).catch(function(error){
			
			console.log(error);
		
		}.bind(this));
	}

	componentDidMount(){
		this.getPermissions();
	}

	render(){
		

		return (<div>
					<div className="row">
						<div className="col-lg-12">
							<h2 className="page-header">Editar Configurações</h2>
						</div>
					</div>
					<div className="panel panel-default">
						<div className="panel-heading">
							Configurações
							<a href="#" onClick={this.handleFormSubmit} className="btn btn-success pull-right"><em className="fa fa-check"></em> Finalizar </a>
							<a href="#/configuracoes" className="btn btn-warning pull-right mr-2"> <i className="fa fa-arrow-left"></i> Voltar </a>
						</div>
						<div className="panel-body">
							{
								this.state.loading ? <div className="col-lg-12">
														<center>
															<img src="/img/sertel-loading.gif" className="loading"/>
														</center>
													</div>
													:
							<ConfigForm show_inputs={this.state.permissions} valuesGetter={this.getValueOf} onInputChange={this.handleInputChange}/>
							}
						</div>
					</div>
					{this.getModalToShow()}
				</div>);
	}
}

module.exports = ConfigLineEdit;