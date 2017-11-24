import React from 'react';
import UrasCreateForm from './UrasCreateForm.jsx';
import {Link, HashRouter as Router} from 'react-router-dom';
import Axios from 'axios';
import FormInterface from '../../../general/FormInterface.jsx';

class UrasCreate extends FormInterface {
	
	constructor(props){
		super(props);

		this.state = {
			nome : "",
			arquivo_audio : "",
			digito_0 : "0",
			digito_1 : "0",
			digito_2 : "0",
			digito_3 : "0",
			digito_4 : "0",
			digito_5 : "0",
			digito_6 : "0",
			digito_7 : "0",
			digito_8 : "0",
			digito_9 : "0",
			digito_ast : "0",
			digito_tralha :"0"
		};

		this.success_message = <div className="alert">
									<h2 className="text-success"><i className="fa fa-check"/>&nbsp;Ura criada com successo !</h2>
								</div>;

		this.onSuccess = () => {
			window.location = "#/uras";
		}

		this.onInputChange = this.onInputChange.bind(this);
		this.getValuesOf = this.getValuesOf.bind(this);
		//this.handleFormSubmit = this.handleFormSubmit.bind(this);
	}


	onInputChange(event){
		event.preventDefault();
		let state = {};
		state[event.target.name] = event.target.type == "file" ? event.target.files[0] : event.target.value;
		this.setState(state);
	}


	getValuesOf(attribute){
		return this.state[attribute];
	}

	/*
	* Sobrepondo o método da classe mãe FormInterface
	*/
	handleFormSubmit(event){
		event.preventDefault();
		this.should_show_modal = true;
		this.errors = [];

		let data = new FormData(),
			digits = [0,1,2,3,4,5,6,7,8,9,"ast", "tralha"],
			digit_label = "";

		data.append("arquivo_audio", this.state.arquivo_audio);
		data.append("nome", this.state.nome);
		
		for(let i=0; i< digits.length; i++){
			digit_label = "digito_".concat(digits[i]);
			data.append(digit_label, this.state[digit_label]);
		}

		Axios({
			
			method: "POST",
			url: _ROUTES_.uras.store,
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
							<h2 className="page-header">Criar Ura</h2>
						</div>
					</div>
					<div className="panel panel-default">
						<div className="panel-heading">
							<a href="#" onClick={this.handleFormSubmit} className="btn btn-success pull-right"><em className="fa fa-check"></em> Finalizar </a>
						</div>
						<div className="panel-body">
							<UrasCreateForm valuesGetter={this.getValuesOf} onInputChange={this.onInputChange}/>
						</div>
					</div>
					{this.getModalToShow()}
				</div>);
	}
}

module.exports = UrasCreate;