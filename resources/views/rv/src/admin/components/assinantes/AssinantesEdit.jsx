import React from 'react';
import AssinantesForm from './AssinantesForm.jsx';
import FormInterface from '../../../general/FormInterface.jsx';
import Axios from 'axios';

class AssinantesEdit extends FormInterface {
	
	constructor(props){
		super(props);

		this.state = {
			/*basico*/
			tipo : "PF",
			nome : "",
			sobrenome : "",
			cpf : "",
			nome_fantasia : "",
			razao_social : "",
			cnpj : "",
			plano: 0,
			inscricao_estadual : "",
			/*contato*/
			cep : "",
			endereco : "",
			complemento : "",
			bairro : "",
			cidade : "",
			estado : "",
			pais : "",
			email : "",
			site : "",
			telefone : "",
			fax : "",
			celular : "",
			/*facilidades*/
			gravacoes : "",
			correio_voz : "",
			grupos_atendimento : "",
			fila : "",
			saudacoes : "",
			ura : "",
			acesso_extrato : "",
			/*financeiro*/
			dias_bloqueio : "",
			dia_vencimento : "",
			alerta_saldo : "",
			espaco_disco : "",
			/*acesso*/
			nome_acesso : "",
			email_acesso : "",
			senha_acesso : "",
			status : 0,
			/*usado para validar os dados de acesso*/
			user_id : ""
		}

		this.route = _ROUTES_.assinantes.update;	

		try{
			this.params = () => {
				return {"a": this.props.location.params.assinante,
						"u": this.state.user_id};
			};
		} catch (e){
			window.location = "#/assinante";
		}

		this.success_message = <div className="alert">
									<h2 className="text-success"><i className="fa fa-check"/>&nbsp;Assinante atualizado com successo !</h2>
								</div>;

		this.onSuccess = () => {
			window.location = "#/assinantes";
		}
		
		this.getRemoteData = this.getRemoteData.bind(this);
	}

	getRemoteData(){
		let assinante_id;

		try{
			 assinante_id = this.props.location.params.assinante;
		} catch (e){
			window.location = "#/assinantes";
		}

		Axios({
			
			method: "GET",
			url: _ROUTES_.assinantes.get,
			params : { a: assinante_id}

		}).then(function(response){

			let assinante = response.data.assinante,
				contato = assinante.contato,
				facilidades = assinante.facilidades,
				financeiro = assinante.financeiro,
				acesso = assinante.acesso,
				new_state = {
					tipo : assinante.tipo == 0 ? "PJ" : "PF",
					nome : assinante.nome,
					sobrenome : assinante.sobrenome,
					cpf : assinante.cpf,
					nome_fantasia : assinante.nome_fantasia,
					razao_social : assinante.razao_social,
					cnpj : assinante.cnpj,
					plano : assinante.plano,
					inscricao_estadual : assinante.inscricao_estadual
				};

				if(contato !== null){
					Object.assign(new_state, {
						cep : contato.cep,
						endereco : contato.endereco,
						complemento : contato.complemento,
						bairro : contato.bairro,
						cidade : contato.cidade,
						estado : contato.estado,
						pais : contato.pais,
						email : contato.email,
						site : contato.site,
						telefone : contato.telefone,
						fax : contato.fax,
						celular : contato.celular
					})
				}

				if(facilidades !== null){
					Object.assign(new_state, {
						gravacoes : facilidades.gravacoes,
						correio_voz : facilidades.correio_voz,
						grupos_atendimento : facilidades.grupos_atendimento,
						fila : facilidades.fila,
						saudacoes : facilidades.saudacoes,
						ura : facilidades.ura,
						acesso_extrato : facilidades.acesso_extrato
					})
				}

				if(financeiro !== null){
					Object.assign(new_state, {
						dias_bloqueio : financeiro.dias_bloqueio,
						dia_vencimento : financeiro.dia_vencimento,
						alerta_saldo : financeiro.alerta_saldo,
						espaco_disco : financeiro.espaco_disco
					})
				}

				if(acesso !== null){
					Object.assign(new_state, {
						nome_acesso : acesso.name,
						email_acesso : acesso.email,
						senha_acesso : "DeFPassWord",
						status : acesso.status,
						user_id : acesso.id
					})
				}
				
				this.setState(new_state);	

		}.bind(this)).catch(function(error){
			
			console.log(error);

		}.bind(this));
	}

	componentDidMount(){
		this.getRemoteData();
	}

	render(){
		let modal = "";
		if(this.hasErrors() && super.shouldShowModal())
			modal = this.getErrorsModal();
		else if(this.hasSucceeded() && super.shouldShowModal())
			modal = this.getSuccessModal();

		return (<div className="panel panel-default">
				    <div className="panel-heading">
				    	Editar Assinante
				    	<a href="#" className="btn btn-success pull-right" onClick={this.handleFormSubmit}> <i className="fa fa-check"></i> Finalizar </a>
				    	<a href="#/assinantes" className="btn btn-warning pull-right mr-2"> <i className="fa fa-arrow-left"></i> Voltar </a>
					</div>
					<div className="panel-body">
						<AssinantesForm onInputChange={this.handleInputChange} valuesGetter={this.getValueOf}/>
					</div>
					{modal}
			   </div>
				);
	}
}

module.exports = AssinantesEdit;
