import React from 'react';
import Axios from 'axios';
import FormInterface from '../../../general/FormInterface.jsx';
import UrasEditForm from './UrasEditForm.jsx';
import {Link, HashRouter as Router} from 'react-router-dom';

class UrasEdit extends FormInterface {
	
	constructor(props){
		super(props);

		this.route = _ROUTES_.linhas.update;
		
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

		try{
			this.params = {"ura": this.props.location.params.ura};
		} catch (e){
			window.location = "#/uras";
		}

		this.success_message = <div className="alert">
									<h2 className="text-success"><i className="fa fa-check"/>&nbsp;Ura atualizada com successo !</h2>
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
	* sobrepondo da classe mãe FormInterface
	*/
	handleFormSubmit(event){
		event.preventDefault();
		this.should_show_modal = true;
		this.errors = [];

		let data = new FormData(),
			digits = [0,1,2,3,4,5,6,7,8,9,"ast", "tralha"],
			digit_label = "";

		if(this.state.arquivo_audio !== "")
			data.append("arquivo_audio", this.state.arquivo_audio);
		
		data.append("nome", this.state.nome);
		data.append("u", this.params.ura);

		for(let i=0; i< digits.length; i++){
			digit_label = "digito_".concat(digits[i]);
			data.append(digit_label, this.state[digit_label]);
		}

		Axios({
			
			method: "POST",
			url: _ROUTES_.uras.update,
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


	componentDidMount(){

		Axios({
			
			method: "GET",
			url: _ROUTES_.uras.get,
			params : {u : this.params.ura}

		}).then(function(response){

			/*função para gerar o prefixo corretamente
			* recebe o destino e o tipo e retorna algo do tipo r_12
			*/
			let get_id_from_digit = (destino, tipo) => {
				let prefix = "";
				switch(tipo){
					case "ramal":
						prefix = "r";
					break;
					case "fila":
						prefix = "f";
					break;
					case "grupo":
						prefix = "g";
					break;
				}

				return prefix.concat("_", destino);
			};

			let ura = response.data;

			this.setState({
							nome : ura.nome,
							digito_0 : get_id_from_digit(ura.dig_0_destino, ura.dig_1_tipo),
							digito_1 : get_id_from_digit(ura.dig_1_destino, ura.dig_1_tipo),
							digito_2 : get_id_from_digit(ura.dig_2_destino, ura.dig_2_tipo),
							digito_3 : get_id_from_digit(ura.dig_3_destino, ura.dig_3_tipo),
							digito_4 : get_id_from_digit(ura.dig_4_destino, ura.dig_4_tipo),
							digito_5 : get_id_from_digit(ura.dig_5_destino, ura.dig_5_tipo),
							digito_6 : get_id_from_digit(ura.dig_6_destino, ura.dig_6_tipo),
							digito_7 : get_id_from_digit(ura.dig_7_destino, ura.dig_7_tipo),
							digito_8 : get_id_from_digit(ura.dig_8_destino, ura.dig_8_tipo),
							digito_9 : get_id_from_digit(ura.dig_9_destino, ura.dig_9_tipo),
							digito_ast : get_id_from_digit(ura.dig_asteristico_destino, ura.dig_asteristico_tipo),
							digito_tralha : get_id_from_digit(ura.dig_tralha_destino, ura.dig_tralha_tipo)
						  });

		}.bind(this)).catch(function(error){
			
			console.log(error);

		}.bind(this));
	}


	render(){
		
		return (<div>
					<div className="row">
						<div className="col-lg-12">
							<h2 className="page-header">Editar Ura</h2>
						</div>
					</div>
					<div className="panel panel-default">
						<div className="panel-heading">
							<a href="#" onClick={this.handleFormSubmit} className="btn btn-success pull-right"><em className="fa fa-check"></em> Finalizar </a>
							<Link to="/uras" className="btn btn-warning pull-right mr-2"><em className="fa fa-arrow-left"></em> Voltar </Link>
						</div>
						<div className="panel-body">
							<UrasEditForm ura_id={this.params.ura} valuesGetter={this.getValuesOf} onInputChange={this.onInputChange}/>
						</div>
					</div>
					{this.getModalToShow()}
				</div>);
	}
}

module.exports = UrasEdit;