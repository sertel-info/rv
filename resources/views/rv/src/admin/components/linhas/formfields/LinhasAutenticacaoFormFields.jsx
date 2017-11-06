import React from 'react';

class LinhasAutenticacaoFormFields extends React.Component {
	
	constructor(props){
		super(props);
		this.props = props;
	}

	render(){
		let onChange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;

		return (<div className="col-lg-6">
					<div className="form-group">
						<label>Login ATA</label>
						<input name="login_ata" onChange={this.props.onInputChange} value={valuesGetter("login_ata")} className="form-control input-sm" placeholder=""/>
					</div>
					<div className="form-group">
						<label>Usuário</label>
						<input name="usuario" onChange={this.props.onInputChange} value={valuesGetter("usuario")} className="form-control input-sm" placeholder=""/>
					</div>
					<div className="form-group">
						<label>Senha</label>
						<input name="senha" onChange={this.props.onInputChange} value={valuesGetter("senha")} className="form-control input-sm" placeholder=""/>
					</div>
					<div className="form-group">
						<label>Endereço IP</label>
						<input name="ip" type="password" onChange={this.props.onInputChange} value={valuesGetter("ip")} className="form-control input-sm" placeholder=""/>
					</div>
					<div className="form-group">
						<label>Porta</label>
						<input name="porta" onChange={this.props.onInputChange} value={valuesGetter("porta")} className="form-control input-sm" placeholder=""/>
					</div>
				</div>);
	}
}

module.exports = LinhasAutenticacaoFormFields;