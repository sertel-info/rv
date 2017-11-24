import React from 'react';

class ConfigCxPostalForm extends React.Component {
	
	constructor(props){
		super(props);
	}

	render(){
		let onInputChange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;

		return (<div className="row col-lg-12">
					<h4><p> Caixa Postal </p></h4>
					<div className="form-group col-lg-3">
							<label>Status</label>
							<select name="caixa_postal" onChange={onInputChange} value={valuesGetter("caixa_postal")} className="form-control" placeholder="">
								<option value="1"> Ativado </option>
								<option value="0"> Desativado</option>
							</select>
					</div>
					<div className="form-group col-lg-4">
						<label>Email</label>
						<input type="text" name="cx_postal_email" onChange={onInputChange} value={valuesGetter("cx_postal_email")} className="form-control input-sm" placeholder="Email"/>
					</div>
					<div className="form-group col-lg-4">
						<label>Senha</label>
						<input type="password" name="cx_postal_pw" onChange={onInputChange} value={valuesGetter("cx_postal_pw")} className="form-control input-sm" placeholder="Senha"/>
					</div>
				</div>);
	}
}

module.exports = ConfigCxPostalForm;