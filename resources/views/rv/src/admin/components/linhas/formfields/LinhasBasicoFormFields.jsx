import React from 'react';
import RemoteDataSelect from '../../../../general/RemoteDataSelect.jsx';

class LinhasBasicoFormFields extends React.Component {
	
	constructor(props){
		super(props);
		this.props = props;
	}

	render(){
		let onChange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;
	
		return (<div className="col-lg-6">
					<div className="form-group">
						<label>Nome</label>
						<input name="nome" onChange={this.props.onInputChange} value={valuesGetter("nome")} className="form-control input-sm" placeholder=""/>
					</div>
					<div className="form-group">
						<label>Assinante</label>
						<RemoteDataSelect src={_ROUTES_.assinantes.get_all} 
										  name="assinante" 
										  onChange={this.props.onInputChange} 
										  value={valuesGetter("assinante")} 
										  className="form-control" 
										  placeholder="">

						<option value="0" disabled> --- Selecione um assinante --- </option>

						</RemoteDataSelect>
					</div>
					<div className="form-group">
						<label>DDD Local</label>
						<input name="ddd_local" onChange={this.props.onInputChange} value={valuesGetter("ddd_local")} className="form-control input-sm" placeholder=""/>
					</div>
					<div className="form-group">
						<label>Simultâneas</label>
						<input name="simultaneas" onChange={this.props.onInputChange} value={valuesGetter("simultaneas")} className="form-control input-sm" placeholder=""/>
					</div>
					<div className="form-group">
						<label>Rota com CLI</label>
						<select name="rota_cli" onChange={this.props.onInputChange} value={valuesGetter("rota_cli")} className="form-control" placeholder="">
							<option> Desativada </option>
							<option> Ativada </option>
						</select>
					</div>
					<div className="form-group">
						<label>Plano</label>
						<RemoteDataSelect src={_ROUTES_.planos.get_all} 
										  name="plano" 
										  onChange={this.props.onInputChange} 
										  value={valuesGetter("plano")} 
										  className="form-control" 
										  placeholder="">

							<option value="0" disabled> --- Selecione um plano --- </option>
							<option value="assinante"> *Usar o mesmo plano do assinante* </option>

						</RemoteDataSelect>
					</div>
				</div>
				);
	}
}

module.exports = LinhasBasicoFormFields;