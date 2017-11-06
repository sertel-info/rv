import React from 'react';

class LinhasPermissoesFormFields extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let onInputChange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;

		return (<div>
					<div className="row col-lg-12">
						<div className="form-group col-lg-3">
								<label> Ligação para FIXO </label>
								<select name="ligacao_fixo" onChange={onInputChange} value={valuesGetter("ligacao_fixo")} className="form-control" placeholder="">
									<option value="1"> Ativado </option>
									<option value="0"> Desativado</option>
								</select>
						</div>
					</div>
					<div className="row col-lg-12">
						<div className="form-group col-lg-3">
								<label> Ligação para MÓVEL </label>
								<select name="ligacao_internacional" onChange={onInputChange} value={valuesGetter("ligacao_internacional")} className="form-control" placeholder="">
									<option value="1"> Ativado </option>
									<option value="0"> Desativado</option>
								</select>
						</div>
					</div>
					<div className="row col-lg-12">
						<div className="form-group col-lg-3">
								<label> Ligação Internacional </label>
								<select name="ligacao_movel" onChange={onInputChange} value={valuesGetter("ligacao_movel")} className="form-control" placeholder="">
									<option value="1"> Ativado </option>
									<option value="0"> Desativado</option>
								</select>
						</div>
					</div>
					<div className="row col-lg-12">
						<div className="form-group col-lg-3">
								<label>Ligação IP x IP </label>
								<select name="ligacao_ip" onChange={onInputChange} value={valuesGetter("ligacao_ip")} className="form-control" placeholder="">
									<option value="1"> Ativado </option>
									<option value="0"> Desativado</option>
								</select>
						</div>
					</div>
					<div className="row col-lg-12">
						<div className="form-group col-lg-3">
								<label> Status </label>
								<select name="status" onChange={onInputChange} value={valuesGetter("status")} className="form-control" placeholder="">
									<option value="1"> Ativado </option>
									<option value="0"> Desativado</option>
								</select>
						</div>
					</div>
				</div>);
	}
}

module.exports = LinhasPermissoesFormFields;