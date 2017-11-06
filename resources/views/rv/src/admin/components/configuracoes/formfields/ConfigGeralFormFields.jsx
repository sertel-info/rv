import React from 'react';

class ConfigGeralFormFields extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let onChange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;

		return (<div className="col-lg-6">
					<div className="form-group">
						<label>Prefixo das Aplicações</label>
						<input onChange={onChange} value={valuesGetter("prefx_aplicacoes")} type="text" className="form-control input-sm" name="prefx_aplicacoes"/>
					</div>
					<div className="form-group">
						<label>Atalho Para Siga-Me</label>
						<input onChange={onChange} value={valuesGetter("atalho_siga_me")} type="text" className="form-control input-sm" name="atalho_siga_me"/>
					</div>
					<div className="form-group">
						<label>Atalho Para Cadeado</label>
						<input onChange={onChange} value={valuesGetter("atalho_cadeado")} type="text" className="form-control input-sm" name="atalho_cadeado"/>
					</div>
				</div>);
	}
}

module.exports = ConfigGeralFormFields;