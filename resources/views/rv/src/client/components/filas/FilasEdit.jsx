import React from 'react';
import FormInterface from '../../../general/FormInterface.jsx';
import FilasForm from './FilasForm.jsx';
import Axios from 'axios';
class FilasEdit extends FormInterface {
	
	constructor(props){
		super(props);
		
		this.state = {
			nome : "",
			tipo : "random",
			tempo_chamada : "30",
			regra_transbordo : "0",
			linhas: []
		}

		this.route = _ROUTES_.filas.update;

		this.success_message = <div className="alert">
									<h2 className="text-success"><i className="fa fa-check"/>&nbsp;Filas atualizada com successo !</h2>
							   </div>;
		
		try{
			this.params = {"f": this.props.location.params.fila};
		} catch (e){
			window.location = "#/filas";
		}

		this.onSuccess = () => {
			window.location = "#/filas";
		}
	}

	componentDidMount(){
		Axios({
			
			method: "GET",
			url: _ROUTES_.filas.get,
			params: {f: this.params.f}

		}).then(function(response){
			
			let fila = response.data.fila;
			console.log(fila);
			this.setState({
				nome : fila.nome,
				tipo : fila.tipo,
				tempo_chamada : fila.tempo_chamada,
				regra_transbordo : fila.regra_transbordo,
				linhas : fila.ids_linhas.map((el) => {return el.toString()})
			});

	
		}.bind(this)).catch(function(error){
			
			console.log(error);

		}.bind(this));
	}

	render(){
		return (
				<div>
					<div className="row">
						<div className="col-lg-12">
							<h2 className="page-header">Editar Fila</h2>
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
				</div>
				);
	}
}

module.exports = FilasEdit;