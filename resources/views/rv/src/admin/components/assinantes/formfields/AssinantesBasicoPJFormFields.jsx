import React from 'react';

class AssinantesBasicoPJFormFields extends React.Component {
	
	constructor(props){
		super(props);
	}


	render(){
		let onchange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;

		return (<div>
					<div className="form-group">
						<label>Nome Fantasia</label>
						<input value={valuesGetter("nome_fantasia")} onChange={onchange} name="nome_fantasia" className="form-control input-sm" placeholder=""/>
					</div>
					<div className="form-group">
						<label>Razão Social</label>
						<input value={valuesGetter("razao_social")} onChange={onchange} name="razao_social" className="form-control input-sm" placeholder=""/>
					</div>
					<div className="form-group">
						<label>CNPJ</label>
						<input value={valuesGetter("cnpj")} onChange={onchange} name="cnpj" className="form-control input-sm" placeholder=""/>
					</div>
					<div className="form-group">
						<label>Inscrição E.</label>
						<input value={valuesGetter("inscricao_estadual")} onChange={onchange} name="inscricao_estadual" className="form-control input-sm" placeholder=""/>
					</div>
				</div>);
	}
}

module.exports = AssinantesBasicoPJFormFields;