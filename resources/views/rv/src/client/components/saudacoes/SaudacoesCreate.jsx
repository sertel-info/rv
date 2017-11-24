import React from 'react';
import FormInterface from '../../../general/FormInterface.jsx';
import SaudacoesCreateForm from './SaudacoesCreateForm.jsx';
import Axios from 'axios';

class SaudacoesCreate extends FormInterface {
	
	constructor(props){
		super(props);

		this.state = {
			nome : "",
			tipo_audio : "obrigatorio",
			arquivo_audio : null,
		}

		this.route = _ROUTES_.saudacoes.store;	
		this.success_message =  <div className="alert">
									<h2 className="text-success"><i className="fa fa-check"/>&nbsp;Saudação criada com successo !</h2>
							    </div>;

		
		this.onSuccess = () => {
			window.location = "#/saudacoes";
		}

		this.onInputChange = this.onInputChange.bind(this);
	}

	onInputChange(event){
		event.preventDefault();
		let state = {};
		state[event.target.name] = event.target.type == "file" ? event.target.files[0] : event.target.value;
		this.setState(state);
	}

	/*
	* Sobrepondo o método da classe mãe FormInterface
	*/
	handleFormSubmit(event){
		event.preventDefault();
		this.should_show_modal = true;
		this.errors = [];

		let data = new FormData();
		data.append("arquivo_audio", this.state.arquivo_audio);
		data.append("nome", this.state.nome);
		data.append("tipo_audio", this.state.tipo_audio);

		Axios({
			
			method: "POST",
			url: _ROUTES_.saudacoes.store,
			data: data

		}).then(function(response){
			
			this.has_succeeded = true;
			this.forceUpdate();

		}.bind(this)).catch(function(error){
			
			let response = error.response;

			if(response.status == 401)
				window.location = "/login";

			if(response.status == 400){
				//this.setState({errors:  response.data.validation_errors});
				this.errors = response.data.validation_errors;
				this.forceUpdate();
			}

			if(response.status == 500){
				//this.setState({errors:  response.data.validation_errors});
				this.errors = ["Um erro inesperado ocorreu, por favor tente novamente"];
				this.forceUpdate();
			}


		}.bind(this));
	}

	render(){
		return (<div>
					<div className="row">
						<div className="col-lg-12">
							<h2 className="page-header">Criar Saudação</h2>
						</div>
					</div>
					<div className="panel panel-default">
						<div className="panel-heading">
							
							<a href="#" className="btn btn-success pull-right" onClick={this.handleFormSubmit}> <i className="fa fa-check"></i> Finalizar </a>
					    	<a href="#/saudacoes" className="btn btn-warning pull-right mr-2"> <i className="fa fa-arrow-left"></i> Voltar </a>
						</div>
						<div className="panel-body">
							<SaudacoesCreateForm valuesGetter={this.getValueOf} onInputChange={this.onInputChange}/>
						</div>
						{this.getModalToShow()}
					</div>
				</div>);
	}
}

module.exports = SaudacoesCreate;