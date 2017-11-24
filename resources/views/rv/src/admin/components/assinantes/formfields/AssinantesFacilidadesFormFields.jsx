import React from 'react';

class AssinantesFacilidadesFormFields extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let onchange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;

		return (<div className="col-lg-6">
				<div className="form-group">
					<label>Gravações</label>
					<select onChange={onchange} value={valuesGetter("gravacoes")} className="form-control" name="gravacoes">
						<option value="1"> Ativado </option>
						<option value="0"> Desativado </option>
					</select>
					</div>
					<div className="form-group">
					<label>Correio de Voz</label>
					<select onChange={onchange} value={valuesGetter("correio_voz")} className="form-control" name="correio_voz">
						<option value="1"> Ativado </option>
						<option value="0"> Desativado </option>
					</select>
					</div>
					<div className="form-group">
					<label>Grupos de Atendimento</label>
					<select onChange={onchange} value={valuesGetter("grupos_atendimento")} className="form-control" name="grupos_atendimento">
						<option value="1"> Ativado </option>
						<option value="0"> Desativado </option>
					</select>
					</div>
					<div className="form-group">
					<label>Filas de Atendimento</label>
					<select onChange={onchange} value={valuesGetter("fila")} className="form-control" name="fila">
						<option value="1"> Ativado </option>
						<option value="0"> Desativado </option>
					</select>
					</div>
					<div className="form-group">
					<label>Áudio de saudação</label>
					<select onChange={onchange} value={valuesGetter("saudacoes")} className="form-control" name="saudacoes">
						<option value="1"> Ativado </option>
						<option value="0"> Desativado </option>
					</select>
					</div>
					<div className="form-group">
					<label>URA de Atendimento</label>
					<select onChange={onchange} value={valuesGetter("ura")} className="form-control" name="ura">
						<option value="1"> Ativado </option>
						<option value="0"> Desativado </option>
					</select>
					</div>
					<div className="form-group">
						<label>Acesso ao Extrato</label>
						<select onChange={onchange} value={valuesGetter("acesso_extrato")} className="form-control" name="acesso_extrato">
							<option value="1"> Ativado </option>
							<option value="0"> Desativado </option>
						</select>
					</div>
					<div className="form-group">
						<label>Acesso ao Cadeado pessoal</label>
						<select onChange={onchange} value={valuesGetter("acesso_cadeado")} className="form-control" name="acesso_cadeado">
							<option value="1"> Ativado </option>
							<option value="0"> Desativado </option>
						</select>
					</div>
					<div className="form-group">
						<label>Acesso a Caixa Postal</label>
						<select onChange={onchange} value={valuesGetter("acesso_cx_postal")} className="form-control" name="acesso_cx_postal">
							<option value="1"> Ativado </option>
							<option value="0"> Desativado </option>
						</select>
					</div>
					<div className="form-group">
						<label>Acesso a Siga-me </label>
						<select onChange={onchange} value={valuesGetter("acesso_siga_me")} className="form-control" name="acesso_siga_me">
							<option value="1"> Ativado </option>
							<option value="0"> Desativado </option>
						</select>
					</div>
					<div className="form-group">
						<label>Acesso a Atendimento automático</label>
						<select onChange={onchange} value={valuesGetter("acesso_at_automatico")} className="form-control" name="acesso_at_automatico">
							<option value="1"> Ativado </option>
							<option value="0"> Desativado </option>
						</select>
					</div>
				</div>);
	}
}

module.exports = AssinantesFacilidadesFormFields;