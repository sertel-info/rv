import React from 'react';

class ConfigSigaMeForm extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let onInputChange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;
			
		return (<div className="row col-lg-12">
					<h4><p> Siga-me </p></h4>
					<div className="form-group col-lg-3">
						<label>Status</label>
						<select name="siga_me" onChange={onInputChange} value={valuesGetter("siga_me")} className="form-control" placeholder="">
							<option value="1"> Ativado </option>
							<option value="0"> Desativado</option>
						</select>
					</div>
					<div className="form-group col-lg-4">
						<label>Número</label>
						<input name="num_siga_me" onChange={onInputChange} value={valuesGetter("num_siga_me")} className="form-control input-sm" placeholder="Número"/>
					</div>
				</div>);
	}
}

module.exports = ConfigSigaMeForm;