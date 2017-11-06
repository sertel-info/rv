import React from 'react';
import Axios from 'axios';
import GruposForm from './GruposForm.jsx';
import FormInterface from '../../../general/FormInterface.jsx'

class GruposEdit extends FormInterface {
	
	constructor(props){
		super(props);

		this.state = {
			nome : "",
			tipo : "hierarquico",
			tempo_chamada : "10",
			linhas : []
		}

		this.route = _ROUTES_.grupos.update;	
		this.success_message =  <div className="alert">
									<h2 className="text-success"><i className="fa fa-check"/>&nbsp;Grupo atualizado com successo !</h2>
							    </div>;

		try{
			this.params = {"g": this.props.location.params.grupo};
		} catch (e){
			window.location = "#/grupos";
		}

		this.onSuccess = () => {
			window.location = "#/grupos";
		}

	}

	componentDidMount(){
		Axios({
			
			method: "GET",
			url: _ROUTES_.grupos.get,
			params: {g: this.params.g}

		}).then(function(response){
			
			let grupo = response.data.grupo;
			this.setState({
				nome : grupo.nome,
				tipo : grupo.tipo,
				tempo_chamada : grupo.tempo_chamada,
				linhas : grupo.ids_linhas.map((el) => {return el.toString()})
			});

	
		}.bind(this)).catch(function(error){
			
			console.log(error);

		}.bind(this));
	}

	render(){
		return (<div className="panel panel-default">
					<div className="panel-heading">
						Editar Grupo
						<a href="#" className="btn btn-success pull-right" onClick={this.handleFormSubmit}> <i className="fa fa-check"></i> Finalizar </a>
				    	<a href="#/grupos" className="btn btn-warning pull-right mr-2"> <i className="fa fa-arrow-left"></i> Voltar </a>
					</div>
					<div className="panel-body">
						<GruposForm valuesGetter={this.getValueOf} onInputChange={this.handleInputChange}/>
					</div>
					{this.getModalToShow()}
				</div>);
	}
}

module.exports = GruposEdit;