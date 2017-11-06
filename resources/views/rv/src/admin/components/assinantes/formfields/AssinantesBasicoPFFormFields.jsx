import React from 'react';

class AssinantesBasicoPFFormFields extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let onchange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;
		return (<div>
					<div className="form-group">
						<label>Nome</label>
						<input value={valuesGetter("nome")} onChange={onchange} name="nome" className="form-control input-sm" placeholder=""/>
					</div>
					<div className="form-group">
						<label>Sobrenome</label>
						<input value={valuesGetter("sobrenome")} onChange={onchange} name="sobrenome" className="form-control input-sm" placeholder=""/>
					</div>
					<div className="form-group">
						<label>CPF</label>
						<input value={valuesGetter("cpf")} onChange={onchange} name="cpf" className="form-control input-sm" placeholder=""/>
					</div>
				</div>);
	}
}

module.exports = AssinantesBasicoPFFormFields;