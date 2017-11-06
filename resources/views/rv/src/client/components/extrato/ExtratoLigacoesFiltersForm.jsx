import React from 'react';
import MaskedInput from 'react-maskedinput';

class ExtratoLigacoesFiltersForm extends React.Component {
	
	constructor(props){
		super(props);
	}

	render(){
		let valuesGetter = this.props.valuesGetter,
			onChange = this.props.onInputChange;

		return (<div className="container-fluid">
				  <div className="form-group row col-lg-12">
				    <label className="control-label"> Tipo de chamada </label>
				    <div className="">
				     	<select value={valuesGetter("tipo_chamada")} onChange={onChange} name="tipo_chamada" className="form-control">
				     		<option value="todos"> Todos </option>
				     		<option value="entrante"> Entrantes </option>
				     		<option value="sainte"> Saintes </option>
				     		<option value="interna"> Internas </option>
				     	</select>
				    </div>
				  </div>
				  
				  <div className="form-group row col-lg-12">
				    <label className="control-label"> Tipo de destino </label>
				    <div className="">
				      <select value={valuesGetter("tipo_destino")} onChange={onChange} name="tipo_destino" className="form-control">
				     		<option value="todos"> Todos </option>
				     		<option value="movel"> Móvel </option>
				     		<option value="fixo"> Fixo </option>
				     		<option value="interno"> Ramal </option>
				      </select>
				    </div>
				  </div>
				  
				  <div className="form-group row col-lg-12">
				    <label className="control-label"> Origem </label>
				    <div className="">
				      	<input value={valuesGetter("origem")} onChange={onChange} name="origem" className="form-control input-sm" type="text"/>
				    </div>
				  </div>
				  
				  <div className="form-group row col-lg-12">
				    <label className="control-label"> Destino </label>
				    <div className="">
				      	<input value={valuesGetter("destino")} onChange={onChange} name="destino" className="form-control input-sm" type="text"/>
				    </div>
				  </div>
				  
				  <div className="form-group row col-lg-12">
					    <label className="control-label"> Data </label><br/>
					    <div className="col-lg-6 pl-0">
					      <MaskedInput mask="11/11/1111" value={valuesGetter("data_min")} onChange={onChange} name="data_min" className="form-control input-sm" placeholder="De" type="text"/>
					    </div>
					    <div className="col-lg-6">
					      <MaskedInput mask="11/11/1111" value={valuesGetter("data_max")} onChange={onChange} name="data_max" className="form-control input-sm" placeholder="Até" type="text"/>
					    </div>
				  </div>
				  
				  <div className="form-group row col-lg-12">
				    <label className="control-label"> Hora </label><br/>
				    <div className="col-lg-6 pl-0">
				      <MaskedInput mask="11:11:11" value={valuesGetter("hora_min")} onChange={onChange} name="hora_min" className="form-control input-sm" placeholder="De" type="text"/>
				    </div>
				    <div className="col-lg-6">
				      <MaskedInput mask="11:11:11" value={valuesGetter("hora_max")} onChange={onChange} name="hora_max" className="form-control input-sm" placeholder="Até" type="text"/>
				    </div>
				  </div>
				  
				  <div className="form-group row col-lg-12">
				    <label className="control-label"> Duração </label><br/>
				    <div className="col-lg-6 pl-0">
				      <MaskedInput mask="11:11:11" value={valuesGetter("duracao_min")} onChange={onChange} name="duracao_min" className="form-control input-sm" placeholder="De" type="text"/>
				    </div>
				    <div className="col-lg-6">
				      <MaskedInput mask="11:11:11" value={valuesGetter("duracao_max")} onChange={onChange} name="duracao_max" className="form-control input-sm" placeholder="Até" type="text"/>
				    </div>
				  </div>

				</div>);
	}
}

module.exports = ExtratoLigacoesFiltersForm;