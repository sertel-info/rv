import React from 'react';

class NotifBasicoFormFields extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let valuesGetter = this.props.valuesGetter,
			onChange = this.props.onInputChange;

		return (<div className="col-lg-6">
					<div className="form-group">
						<label>Status</label>
						<select onChange={onChange} value={valuesGetter("status")} className="form-control" name="status">
							<option value="1">Ativado</option>
							<option value="0">Desativado</option>
						</select>
					</div>
					<div className="form-group">
						<label>Nome de identificação</label>
						<input name="nome" onChange={onChange} value={valuesGetter("nome")} className="form-control input-sm" placeholder=""/>
					</div>
					<div className="form-group">
						<label>Evento</label>
						<select onChange={onChange} value={valuesGetter("escutar_evento")} className="form-control" name="escutar_evento">
							<option value="none">Nenhum</option>
							<option value="CreditosAcabando">Créditos Acabando</option>
							<option value="CreditosRemovidos">Créditos Removidos</option>
							<option value="CreditosAdicionados">Créditos Adicionados</option>
						</select>
					</div>
					<div className="form-group">
						<label>Nível</label>
						<select onChange={onChange} value={valuesGetter("nivel")} className="form-control" name="nivel">
							<option value="danger">Perigo</option>
							<option value="warning">Aviso</option>
							<option value="success">Sucesso</option>
						</select>
					</div>
					<div className="form-group">
						<label>Título</label>
						<input name="titulo" onChange={onChange} value={valuesGetter("titulo")} className="form-control input-sm" placeholder=""/>
					</div>
					<div className="form-group">
						<label>Mensagem</label>
						<input name="mensagem" onChange={onChange} value={valuesGetter("mensagem")} className="form-control input-sm" placeholder=""/>
					</div>
				</div>);
	}
}

module.exports = NotifBasicoFormFields;