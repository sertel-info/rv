import React from 'react';

class LinhasConfiguracoesFormFields extends React.Component {
	
	constructor(props){
		super(props);
	}

	render(){
		let valuesGetter = this.props.valuesGetter,
			onInputChange = this.props.onInputChange;

		return (<div className="col-lg-6">
					<div className="form-group">
						<label>CallerID</label>
						<input onChange={onInputChange} value={valuesGetter("callerid")} name="callerid"  className="form-control input-sm" placeholder=""/>
					</div>
					<div className="form-group">
						<label>Call group</label>
						<input onChange={onInputChange} value={valuesGetter("call_group")} name="call_group" className="form-control input-sm" placeholder=""/>
					</div>
					<div className="form-group">
						<label>Pickup group</label>
						<input onChange={onInputChange} value={valuesGetter("pickup_group")} name="pickup_group"  className="form-control input-sm" placeholder=""/>
					</div>
					<div className="form-group">
						<label>Envio de DTMF</label>
						<select onChange={onInputChange} value={valuesGetter("envio_dtmf")} name="envio_dtmf" className="form-control" placeholder="">
							<option value="auto">AUTO (Automático)</option>
							<option value="rfc2833">RFC2833 (padrão)</option>
							<option value="inband">INBAND (Apenas G711)</option>
							<option value="info">INFO</option>
						</select>
					</div>
					<div className="form-group">
						<label>Ring Falso</label>
						<select onChange={onInputChange} value={valuesGetter("ring_falso")} name="ring_falso" className="form-control" placeholder="">
							<option value="1"> Ativado </option>
							<option value="0"> Desativado</option>
						</select>
					</div>
					<div className="form-group">
						<label>NAT</label>
						<select onChange={onInputChange} value={valuesGetter("nat")} name="nat" className="form-control" placeholder="">
							<option value="1"> Ativado </option>
							<option value="0"> Desativado</option>
						</select>
					</div>
				</div>);
	}
}

module.exports = LinhasConfiguracoesFormFields;