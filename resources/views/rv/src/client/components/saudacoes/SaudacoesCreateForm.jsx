import React from 'react';

class SaudacoesForm extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let onChange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;

		return (
				<div className="col-lg-6">
					<div className="form-group">
						<label> Nome </label>
						<input onChange={onChange} value={valuesGetter("nome")}  className="form-control input-sm" type="text" name="nome"/> 
					</div>
					<div className="form-group">
						<label>Tipo</label>
						<select name="tipo_audio" value={valuesGetter("tipo_audio")} onChange={onChange} className="form-control" placeholder="">
							<option value="obrigatorio">Obrigatório</option>
							<option value="opcional">Opcional</option>
						</select>
					</div>
					<div className="form-group">
						<label> Arquivo de Áudio </label>
						<input onChange={onChange}  type="file" name="arquivo_audio"/> 
						<p className="help-block">O arquivo precisa ter o formato wav</p>
					</div>
				</div>
				);
	}
}

module.exports = SaudacoesForm;