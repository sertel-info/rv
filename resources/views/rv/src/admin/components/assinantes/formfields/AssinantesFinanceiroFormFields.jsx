import React from 'react';

class AssinantesFinanceiroFormFields extends React.Component {
	
	constructor(props){
		super(props);
	}

	render(){
		let onchange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;

		return (<div className="col-md-6">
					<div className="form-group">
						<label>Dias para bloqueio</label>
						<input onChange={onchange} value={valuesGetter("dias_bloqueio")} type="text" className="form-control input-sm" name="dias_bloqueio"/>
					</div>
					<div className="form-group">
						<label>Dia do Vencimento</label>
						<input onChange={onchange} value={valuesGetter("dia_vencimento")} type="text" className="form-control input-sm" name="dia_vencimento"/>
					</div>
					<div className="form-group">
						<label>Alerta de Saldo</label>
						<input onChange={onchange} value={valuesGetter("alerta_saldo")} type="text" className="form-control input-sm" name="alerta_saldo"/>
					</div>
					<div className="form-group">
						<label>Espaço em Disco</label>
						<input onChange={onchange} value={valuesGetter("espaco_disco")} type="text" className="form-control input-sm" name="espaco_disco"/>
					</div>
				</div>);
	}
}

module.exports = AssinantesFinanceiroFormFields;