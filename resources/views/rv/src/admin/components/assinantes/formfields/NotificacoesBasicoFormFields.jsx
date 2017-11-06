import React from 'react';

class NotificacoesFormFields extends React.Component {
	
	constructor(props){
		super(props);
	}

	render(){
		let onChange = this.props.onChange,
			valuesGetter = this.props.valuesGetter;

		return (<div className="col-lg-6">
						<div className="form-group">
							<label> Nível </label>
							<select value="" onChange={onChange} value={valuesGetter("nivel")} name="nivel" className="form-control" placeholder="">
								<option value="danger"> Perigo </option>
								<option value="warning"> Aviso </option>
								<option value="success"> Sucesso </option>
							</select>
						</div>
						<div className="form-group">
							<label> Título </label>
							<input onChange={onChange} value={valuesGetter("titulo")}  className="form-control" type="text" name="titulo"/> 
						</div>
						<div className="form-group">
							<label> Texto </label>
							<input onChange={onChange} value={valuesGetter("mensagem")} className="form-control" type="text" name="mensagem"/> 
						</div>
				</div>);
	}
}

module.exports = NotificacoesFormFields;