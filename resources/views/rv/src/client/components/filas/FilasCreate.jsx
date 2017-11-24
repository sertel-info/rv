import React from 'react';
import FilasForm from './FilasForm.jsx';
import FormInterface from '../../../general/FormInterface.jsx';

class FilasCreate extends FormInterface {
	
	constructor(props){
		super(props);
		
		this.state = {
			nome : "",
			tipo : "random",
			tempo_chamada : "30",
			regra_transbordo : "0",
			linhas: []
		}

		this.route = _ROUTES_.filas.store;

		this.success_message = <div className="alert">
									<h2 className="text-success"><i className="fa fa-check"/>&nbsp;Filas criada com successo !</h2>
							   </div>;


		this.onSuccess = () => {
			window.location = "#/filas";
		}
	}

	render(){
		return (<div>
					<div className="row">
						<div className="col-lg-12">
							<h2 className="page-header">Criar Fila</h2>
						</div>
					</div>
					<div className="panel panel-default">
						<div className="panel-heading">
							
							<a href="#" onClick={this.handleFormSubmit} className="btn btn-success pull-right"><em className="fa fa-check"></em> Finalizar </a>
						</div>
						<div className="panel-body">
							<FilasForm valuesGetter={this.getValueOf} onInputChange={this.handleInputChange}/>
						</div>
					</div>
					{this.getModalToShow()}
				</div>);
	}
}

module.exports = FilasCreate;