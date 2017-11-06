import React from 'react';

class AssinantesContatoFormFields extends React.Component {
	
	constructor(props){
		super(props);

	}
	
	render(){
		let onchange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;

		return (<div className="col-lg-6">
					<div className="form-group">
						<label>Cep</label>
						<input onChange={onchange} value={valuesGetter("cep")} type="text" className="form-control input-sm" name="cep"/>
					</div>
					<div className="form-group">
						<label>Endereço</label>
						<input onChange={onchange} value={valuesGetter("endereco")} type="text" className="form-control input-sm" name="endereco"/>
					</div>
					<div className="form-group">
						<label>Complemento</label>
						<input onChange={onchange} value={valuesGetter("complemento")} type="text" className="form-control input-sm" name="complemento"/>
					</div>
					<div className="form-group">
						<label>Bairro</label>
						<input onChange={onchange} value={valuesGetter("bairro")} type="text" className="form-control input-sm" name="bairro"/>
					</div>
					<div className="form-group">
						<label>Cidade</label>
						<input onChange={onchange} value={valuesGetter("cidade")} type="text" className="form-control input-sm" name="cidade"/>
					</div>
					<div className="form-group">
						<label>Estado/UF</label>
						<input onChange={onchange} value={valuesGetter("estado")} type="text" className="form-control input-sm" name="estado"/>
					</div>
					<div className="form-group">
						<label>País</label>
						<input onChange={onchange} value={valuesGetter("pais")} type="text" className="form-control input-sm" name="pais"/>
					</div>
					<div className="form-group">
						<label>E-Mail</label>
						<input onChange={onchange} value={valuesGetter("email")} type="text" className="form-control input-sm" name="email"/>
					</div>
					<div className="form-group">
						<label>Site/Homepage</label>
						<input onChange={onchange} value={valuesGetter("site")} type="text" className="form-control input-sm" name="site"/>
					</div>
					<div className="form-group">
						<label>Telefone</label>
						<input onChange={onchange} value={valuesGetter("telefone")} type="text" className="form-control input-sm" name="telefone"/>
					</div>
					<div className="form-group">
						<label>Num. Fax</label>
						<input onChange={onchange} value={valuesGetter("fax")} type="text" className="form-control input-sm" name="fax"/>
					</div>
					<div className="form-group">
						<label>Celular</label>
						<input onChange={onchange} value={valuesGetter("celular")} type="text" className="form-control input-sm" name="celular"/>
					</div>
				</div>);
	}
}

module.exports = AssinantesContatoFormFields;