import React from 'react';

class ConfigCadeadoForm extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let onInputChange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;

		return (<div className="row col-lg-12">
					<h4><p> Cadeado pessoal </p></h4>
					<div className="form-group col-lg-3">
							<label> Status </label>
							<select name="cadeado_pessoal" onChange={onInputChange} value={valuesGetter("cadeado_pessoal")} className="form-control" placeholder="">
								<option value="1"> Ativado </option>
								<option value="0"> Desativado</option>
							</select>
					</div>
					<div className="form-group col-lg-4">
						<label>PIN</label>
						<input type="text" placeholder="PIN" name="cadeado_pin" onChange={onInputChange} value={valuesGetter("cadeado_pin")} className="form-control input-sm"/>
					</div>
				</div>);
	}
}

module.exports = ConfigCadeadoForm;