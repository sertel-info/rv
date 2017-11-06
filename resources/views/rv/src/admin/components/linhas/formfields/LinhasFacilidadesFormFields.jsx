import React from 'react';

class LinhasFacilidadesFormFields extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let valuesGetter = this.props.valuesGetter,
			onInputChange = this.props.onInputChange;

		return (<div className="col-lg-12">
					<div className="row col-lg-12">
						<div className="form-group col-lg-3">
								<label>Gravação</label>
								<select  name="gravacao" onChange={onInputChange} value={valuesGetter("gravacao")} className="form-control" placeholder="">
									<option value="1"> Ativado </option>
									<option value="0"> Desativado</option>
								</select>
						</div>
					</div>
					<div className="row col-lg-12">
						<div className="form-group col-lg-3">
								<label>Pode ser monitorado</label>
								<select name="monitoravel" onChange={onInputChange} value={valuesGetter("monitoravel")} className="form-control" placeholder="">
									<option value="1"> Ativado </option>
									<option value="0"> Desativado</option>
								</select>
						</div>
					</div>
					<div className="row col-lg-12">
						<div className="form-group col-lg-3">
								<label>Pode monitorar</label>
								<select name="pode_monitorar" onChange={onInputChange} value={valuesGetter("pode_monitorar")} className="form-control" placeholder="">
									<option value="1"> Ativado </option>
									<option value="0"> Desativado</option>
								</select>
						</div>
					</div>
					<div className="row col-lg-12">
						<div className="form-group col-lg-3">
								<label>Cadeado pessoal</label>
								<select name="cadeado_pessoal" onChange={onInputChange} value={valuesGetter("cadeado_pessoal")} className="form-control" placeholder="">
									<option value="1"> Ativado </option>
									<option value="0"> Desativado</option>
								</select>
						</div>
						<div className="form-group col-lg-4">
							<label>PIN</label>
							<input name="cadeado_pin" onChange={onInputChange} value={valuesGetter("cadeado_pin")} className="form-control input-sm" placeholder=""/>
						</div>
					</div>
					<div className="row col-lg-12">
						<div className="form-group col-lg-3">
								<label>Caixa postal</label>
								<select name="caixa_postal" onChange={onInputChange} value={valuesGetter("caixa_postal")} className="form-control" placeholder="">
									<option value="1"> Ativado </option>
									<option value="0"> Desativado</option>
								</select>
						</div>
						<div className="form-group col-lg-4">
							<label>Senha de acesso</label>
							<input name="cx_postal_pw" onChange={onInputChange} value={valuesGetter("cx_postal_pw")} className="form-control input-sm" placeholder="" type="password"/>
						</div>
						<div className="form-group col-lg-4">
							<label>Email</label>
							<input name="cx_postal_email" onChange={onInputChange} value={valuesGetter("cx_postal_email")} className="form-control input-sm" placeholder="" type="password"/>
						</div>
					</div>
					<div className="row col-lg-12">
						<div className="form-group col-lg-3">
								<label>Siga-me</label>
								<select name="siga_me" onChange={onInputChange} value={valuesGetter("siga_me")} className="form-control" placeholder="">
									<option value="1"> Ativado </option>
									<option value="0"> Desativado</option>
								</select>
						</div>
						<div className="form-group col-lg-4">
							<label>Número</label>
							<input name="num_siga_me" onChange={onInputChange} value={valuesGetter("num_siga_me")} className="form-control input-sm" placeholder=""/>
						</div>
					</div>
				</div>);
	}
}

module.exports = LinhasFacilidadesFormFields;