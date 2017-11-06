import React from 'react';
import FormInterface from '../../../general/FormInterface.jsx';
import PlanosForm from './PlanosForm.jsx';

class PlanosCreate extends FormInterface {
	
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

		this.route = _ROUTES_.planos.store;	
		this.success_message = <div className="alert">
									<h2 className="text-success"><i className="fa fa-check"/>&nbsp;Plano criado com successo !</h2>
							   </div>;

		this.onSuccess = () => {
			window.location = "#/planos";
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
				    	Criar Plano
				    	<a href="#" className="btn btn-success pull-right" onClick={this.handleFormSubmit}> <i className="fa fa-check"></i> Finalizar </a>
				    	<a href="#/linhas" className="btn btn-warning pull-right mr-2"> <i className="fa fa-arrow-left"></i> Voltar </a>
					</div>
					<div className="panel-body">
						<PlanosForm onInputChange={this.handleInputChange} valuesGetter={this.getValueOf}/>
					</div>
					 {modal}
			   </div>
				);
	}
}

module.exports = PlanosCreate;