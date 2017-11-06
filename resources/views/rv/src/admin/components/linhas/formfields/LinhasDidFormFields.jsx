import React from 'react';

class LinhasDidFormFields extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let valuesGetter = this.props.valuesGetter,
			onInputChange = this.props.onInputChange;

		return (<div className="col-lg-6">
					<div className="form-group">
						<label>Status</label>
						<select name="status_did" onChange={onInputChange} value={valuesGetter("status_did")} className="form-control" placeholder="">
							<option value="1"> Ativado </option>
							<option value="0"> Desativado</option>
						</select>
					</div>
					<div className="form-group">
						<label>Usuário</label>
						<input name="usuario_did" onChange={onInputChange} value={valuesGetter("usuario_did")} className="form-control input-sm" placeholder=""/>
					</div>
					<div className="form-group">
						<label>Senha</label>
						<input name="senha_did" onChange={onInputChange} value={valuesGetter("senha_did")} className="form-control input-sm" placeholder=""/>
					</div>
					<div className="form-group">
						<label>Endereço IP</label>
						<input name="ip_did" onChange={onInputChange} value={valuesGetter("ip_did")} className="form-control input-sm" placeholder=""/>
					</div>
					<div className="form-group">
						<label>Extensão</label>
						<input name="extensao_did" onChange={onInputChange} value={valuesGetter("extensao_did")} className="form-control input-sm" placeholder=""/>
					</div>
				</div>);
	}
}

module.exports = LinhasDidFormFields;