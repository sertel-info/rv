import React from 'react';
import AssinantesForm from './AssinantesForm.jsx';
import FormInterface from '../../../general/FormInterface.jsx';

class AssinantesCreate extends FormInterface {
	
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
			status : 0
		}

		this.route = _ROUTES_.assinantes.store;	
		this.success_message = <div className="alert">
									<h2 className="text-success"><i className="fa fa-check"/>&nbsp;Assinante criado com successo !</h2>
								</div>;

		this.onSuccess = () => {
			window.location = "#/assinantes";
		}
	}

	render(){
		let modal = "";
		if(this.hasErrors() && super.shouldShowModal())
			modal = this.getErrorsModal();
		else if(this.hasSucceeded() && super.shouldShowModal())
			modal = this.getSuccessModal();

		return (<div className="panel panel-default">
				    <div className="panel-heading">
				    	Criar Assinante
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

module.exports = AssinantesCreate;