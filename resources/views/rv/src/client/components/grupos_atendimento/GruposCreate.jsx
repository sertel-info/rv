import React from 'react';
import FormInterface from '../../../general/FormInterface.jsx'
import GruposForm from './GruposForm.jsx'

class GruposCreate extends FormInterface {
	
	constructor(props){
		super(props);
	
		this.state = {
			nome : "",
			tipo : "hierarquico",
			tempo_chamada : "10",
			linhas : []
		}

		this.route = _ROUTES_.grupos.store;	
		this.success_message =  <div className="alert">
									<h2 className="text-success"><i className="fa fa-check"/>&nbsp;Grupo criado com successo !</h2>
							    </div>;

		
		this.onSuccess = () => {
			window.location = "#/grupos";
		}

	}

	render(){
		return (
				<div className="panel panel-default">
					<div className="panel-heading">
						Criar Grupo
						<a href="#" className="btn btn-success pull-right" onClick={this.handleFormSubmit}> <i className="fa fa-check"></i> Finalizar </a>
				    	<a href="#/grupos" className="btn btn-warning pull-right mr-2"> <i className="fa fa-arrow-left"></i> Voltar </a>
					</div>
					<div className="panel-body">
						<GruposForm valuesGetter={this.getValueOf} onInputChange={this.handleInputChange}/>
					</div>
					{this.getModalToShow()}
				</div>
				);
	}
}

module.exports = GruposCreate;