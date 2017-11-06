import React from 'react';

class NotifEmailFormFields extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let valuesGetter = this.props.valuesGetter,
			onChange = this.props.onInputChange;

		return (<div className="col-lg-6">
					<div className="form-group">
						<label>Status</label>
						<select onChange={onChange} value={valuesGetter("ativar_email")} className="form-control" name="ativar_email">
							<option value="1">Ativado</option>
							<option value="0">Desativado</option>
						</select>
					</div>
					<div className="form-group">
						<label>Assunto do email</label>
						<input name="email_assunto" onChange={onChange} value={valuesGetter("email_assunto")} className="form-control input-sm" placeholder=""/>
					</div>
					<div className="form-group">
						<label>Texto do email</label>
						<textarea style={{minHeight:"100px"}} name="email_corpo" onChange={onChange} value={valuesGetter("email_corpo")} className="form-control input-sm" placeholder=""/>
					</div>
				</div>);
	}
}

module.exports = NotifEmailFormFields;