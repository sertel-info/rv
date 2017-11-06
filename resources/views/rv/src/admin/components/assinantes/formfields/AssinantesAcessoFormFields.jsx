import React from 'react';

class AssinantesAcessoFormFields extends React.Component {
	
	constructor(props){
		super(props);
	}

	render(){
		let onchange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;

		return (<div className="col-lg-6">
					<div className="form-group">
						<label>Nome</label>
						<input onChange={onchange} value={valuesGetter("nome_acesso")} type="text" className="form-control input-sm" name="nome_acesso"/>
					</div>
					<div className="form-group">
						<label>Email</label>
						<input onChange={onchange} value={valuesGetter("email_acesso")} type="text" className="form-control input-sm" name="email_acesso"/>
					</div>
					<div className="form-group">
						<label>Senha</label>
						<input onChange={onchange} value={valuesGetter("senha_acesso")} type="password" className="form-control input-sm" name="senha_acesso"/>
					</div>
					<div className="form-group">
						<label>Status</label>
						<select onChange={onchange} value={valuesGetter("status")} className="form-control" name="status">
							<option value="1"> Ativado </option>
							<option value="0"> Desativado </option>
						</select>
					</div>
				</div>);
	}
}

module.exports = AssinantesAcessoFormFields;