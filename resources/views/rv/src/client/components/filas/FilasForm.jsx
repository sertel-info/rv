import React from 'react';
import ClientLinhasPickList from '../form_components/ClientLinhasPickList.jsx';

class FilasForm extends React.Component {
	
	constructor(props){
		super(props);
	}

	render(){
		let valuesGetter = this.props.valuesGetter,
			onChange = this.props.onInputChange;

		return (<div>
					 <div className="col-lg-6">
					  <div className="form-group row col-lg-12">
					    <label className="control-label"> Nome </label>
					    <div className="">
					      	<input value={valuesGetter("nome")} onChange={onChange} name="nome" className="form-control input-sm" type="text"/>
					    </div>
					  </div>

					  <div className="form-group row col-lg-12">
					    <label className="control-label"> Tipo </label>
					    <div className="">
						    <select value={valuesGetter("tipo")} onChange={onChange} name="tipo" className="form-control">
						     	<option value="random">Randômico</option>
						     	<option value="ringall">Ringall</option>
						     	<option value="linear">Linear</option>
						    </select>
					    </div>
					  </div>

					  <div className="form-group row col-lg-12">
					    <label className="control-label"> Tempo de chamada </label>
					    <div className="">
					        <select value={valuesGetter("tempo_chamada")} onChange={onChange} name="tempo_chamada" className="form-control">
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

					  <div className="form-group row col-lg-12">
					    <label className="control-label"> Regra de transbordo </label>
					    <div className="">
					      <select value={valuesGetter("regra_transbordo")} onChange={onChange} name="regra_transbordo" className="form-control">
					     		<option value="0">Desativado</option>
					     		<option value="1">Ativado</option>
					      </select>
					    </div>
					  </div>
					</div>
					<div className="col-lg-12">
						<label>Linhas</label>
						<ClientLinhasPickList name="linhas" onChange={onChange} value={valuesGetter("linhas")} />
					</div>
				</div>);
	}
}

module.exports = FilasForm;