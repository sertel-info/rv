import React from 'react';
import ClientLinhasPickList from '../form_components/ClientLinhasPickList.jsx';

class GruposForm extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let onChange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;

		return (<div>
					<div className="col-lg-12">
						<div className="col-lg-6">
							<div className="form-group">
								<label> Nome </label>
								<input onChange={onChange} value={valuesGetter("nome")}  className="form-control" type="text" name="nome"/> 
							</div>
							<div className="form-group">
								<label>Tipo</label>
								<select name="tipo" value={valuesGetter("tipo")} onChange={onChange} className="form-control" placeholder="">
									<option value="hierarquico">Hierárquico</option>
									<option value="distribuidor">Distribuidor</option>
									<option value="multiplo">Múltiplo</option>
								</select>
							</div>
							<div className="form-group">
								<label>Tempo Chamada</label>
								<select name="tempo_chamada" value={valuesGetter("tempo_chamada")} onChange={onChange} className="form-control" placeholder="">
									<option value="10">10 segundos</option>
									<option value="20">20 segundos</option>
									<option value="30">30 segundos</option>
									<option value="40">40 segundos</option>
									<option value="50">50 segundos</option>
									<option value="60">60 segundos</option>
									<option value="70">70 segundos</option>
									<option value="80">80 segundos</option>
									<option value="90">90 segundos</option>
									<option value="100">100 segundos</option>
								</select>
							</div>
						</div>
					</div>
					<div className="col-lg-12 form-group">
						<div className="col-lg-11">
							<label>Linhas</label>
							<ClientLinhasPickList name="linhas" onChange={onChange} value={valuesGetter("linhas")} />
						</div>
					</div>
				</div>);
	}
}

module.exports = GruposForm;