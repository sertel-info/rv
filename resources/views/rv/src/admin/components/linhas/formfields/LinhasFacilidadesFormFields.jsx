import React from 'react';

class LinhasFacilidadesFormFields extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let valuesGetter = this.props.valuesGetter,
			onInputChange = this.props.onInputChange;

		return (<div className="col-lg-3">
					<div className="form-group">
						<label>Pode ser monitorado</label>
						<select name="monitoravel" onChange={onInputChange} value={valuesGetter("monitoravel")} className="form-control" placeholder="">
							<option value="1"> Ativado </option>
							<option value="0"> Desativado</option>
						</select>
					</div>
					<div className="form-group">
							<label>Pode monitorar</label>
							<select name="pode_monitorar" onChange={onInputChange} value={valuesGetter("pode_monitorar")} className="form-control" placeholder="">
								<option value="1"> Ativado </option>
								<option value="0"> Desativado</option>
							</select>
					</div>
				</div>);
	}
}

module.exports = LinhasFacilidadesFormFields;