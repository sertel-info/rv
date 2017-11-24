import React from 'react';
import FormInterface from '../../../general/FormInterface.jsx';
import PlanosForm from './PlanosForm.jsx';
import Axios from 'axios';

class PlanosEdit extends FormInterface {
	
	constructor(props){
		super(props);

		this.state = {
			"nome": "",
    		//"tipo": "",
			"valor_sms": 0.00,
			"valor_fixo_local": 0.00,
			"valor_fixo_ddd": 0.00,
			"valor_movel_local": 0.00,
			"valor_movel_ddd": 0.00,
			"valor_ddi": 0.00,
			"valor_ip": 0.00,
			"valor_movel_entrante": 0.00,
			"valor_fixo_entrante": 0.00,
			"descricao": "",
		}

		try{
			this.params = {"p" : this.props.location.params.p};
		} catch (e){
			window.location = "#/planos";
		}

		this.route = _ROUTES_.planos.update;	
		this.success_message = <div className="alert">
									<h2 className="text-success"><i className="fa fa-check"/>&nbsp;Plano atualizado com successo !</h2>
							   </div>;

		this.onSuccess = () => {
			window.location = "#/planos";
		}

	}

	/*Sobrepondo o método do FormInterface*/
	handleFormSubmit(event){
		event.preventDefault();
		this.should_show_modal = true;
		this.errors = [];

		let data = {
			"nome": this.state.nome,
    		//"tipo": "",
			"valor_sms": this.state.valor_sms.toString().replace(/\./g, '').replace(/,/g, '.').replace(/[^0-9\.]+/g, ''),
			"valor_fixo_local": this.state.valor_fixo_local.toString().replace(/\./g, '').replace(/,/g, '.').replace(/[^0-9\.]+/g, ''),
			"valor_fixo_ddd": this.state.valor_fixo_ddd.toString().replace(/\./g, '').replace(/,/g, '.').replace(/[^0-9\.]+/g, ''),
			"valor_movel_local": this.state.valor_movel_local.toString().replace(/\./g, '').replace(/,/g, '.').replace(/[^0-9\.]+/g, ''),
			"valor_movel_ddd": this.state.valor_movel_ddd.toString().replace(/\./g, '').replace(/,/g, '.').replace(/[^0-9\.]+/g, ''),
			"valor_ddi": this.state.valor_ddi.toString().replace(/\./g, '').replace(/,/g, '.').replace(/[^0-9\.]+/g, ''),
			"valor_ip": this.state.valor_ip.toString().replace(/\./g, '').replace(/,/g, '.').replace(/[^0-9\.]+/g, ''),
			"valor_movel_entrante": this.state.valor_movel_entrante.toString().replace(/\./g, '').replace(/,/g, '.').replace(/[^0-9\.]+/g, ''),
			"valor_fixo_entrante": this.state.valor_fixo_entrante.toString().replace(/\./g, '').replace(/,/g, '.').replace(/[^0-9\.]+/g, ''),
			"descricao": this.state.descricao,
			"p": this.params.p
		}

		Axios({

			method: "POST",
			url: this.route,
			data : data

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
			url: _ROUTES_.planos.get,
			params: {"p":this.params.p}
		
		}).then(function(response){
			
			let plano = response.data.plano;
			this.setState({
				"nome": plano.nome,
	    		//"tipo": "",
				"valor_sms": parseFloat(plano.valor_sms),
				"valor_fixo_local": parseFloat(plano.valor_fixo_local),
				"valor_fixo_ddd": parseFloat(plano.valor_fixo_ddd),
				"valor_movel_local": parseFloat(plano.valor_movel_local),
				"valor_movel_ddd": parseFloat(plano.valor_movel_ddd),
				"valor_ddi": parseFloat(plano.valor_ddi),
				"valor_ip": parseFloat(plano.valor_ip),
				"valor_movel_entrante": parseFloat(plano.valor_movel_entrante),
				"valor_fixo_entrante": parseFloat(plano.valor_fixo_entrante),
				"descricao": plano.descricao
			});

		}.bind(this)).catch(function(error){
			
			console.log(error);

		}.bind(this));
	}

	render(){
		return (<div>
					<div className="row">
						<div className="col-lg-12">
							<h2 className="page-header">Editar Plano</h2>
						</div>
					</div>
					<div className="panel panel-default">
					    <div className="panel-heading">
					    	<a href="#" className="btn btn-success pull-right" onClick={this.handleFormSubmit}> <i className="fa fa-check"></i> Finalizar </a>
					    	<a href="#/planos" className="btn btn-warning pull-right mr-2"> <i className="fa fa-arrow-left"></i> Voltar </a>
						</div>
						<div className="panel-body">
							<PlanosForm onInputChange={this.handleInputChange} valuesGetter={this.getValueOf}/>
						</div>
						 {this.getModalToShow()}
				   </div>
			   </div>
				);
	}
}

module.exports = PlanosEdit;