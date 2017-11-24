import React from 'react';
import Axios from 'axios';

class ConfigSaudacoesForm extends React.Component {
	
	constructor(props){
		super(props);
		this.options = [];

		this.state = {
			loading : true
		}
	}

	componentDidMount(){
		Axios({
			
			method: "GET",
			url: _ROUTES_.configuracoes.get_saudacoes_list
		
		}).then(function(response){

			this.options = response.data.map(function(saud){
				return <option value={saud.id}> {saud.nome} </option>;
			});

			this.setState({loading: false});

		}.bind(this)).catch(function(error){
			
			console.log(error);

		}.bind(this));
	}

	render(){
		let onInputChange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;
		
		let options = this.options;

		if(options.length == 0)
			options = <option value=""> Nenhuma opção disponível </option>;
					 
		return (<div className="row col-lg-12">
					<h4><p> Saudação </p></h4>
					<div className="form-group col-lg-3">
							<label>Status</label>
							<select name="saudacao" onChange={onInputChange} value={valuesGetter("saudacao")} className="form-control" placeholder="">
								<option value="1"> Ativado </option>
								<option value="0"> Desativado </option>
							</select>
					</div>
					<div className="form-group col-lg-4">
						<label>&nbsp;</label>
						{
							this.state.loading ? 
								<div className="col-lg-12"> <img className="loading-sm" src="/img/sertel-loading.gif"></img> </div>
								:
								<select name="saudacao_destino" onChange={onInputChange} value={valuesGetter("saudacao_destino")} className="form-control" placeholder="">
									<option value="0" disabled> -- Atendedor -- </option>
									{options}
								</select>
						}
					</div>
				</div>);
	}
}

module.exports = ConfigSaudacoesForm;