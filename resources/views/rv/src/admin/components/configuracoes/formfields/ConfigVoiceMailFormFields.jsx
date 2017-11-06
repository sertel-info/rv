import React from 'react';

class ConfigVoiceMailFormFields extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let onChange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;
			
		return (<div className="col-lg-6">
					<div className="form-group">
						<label>Remetente Padrão</label>
						<input onChange={onChange} value={valuesGetter("voice_mail_remetente_padrao")} type="text" className="form-control input-sm" name="voice_mail_remetente_padrao"/>
					</div>
					<div className="form-group">
						<label>Assunto Padrão</label>
						<input onChange={onChange} value={valuesGetter("voice_mail_assunto_padrao")} type="text" className="form-control input-sm" name="voice_mail_assunto_padrao"/>
					</div>
					<div className="form-group">
						<label>Mensagem Padrão</label>
						<input onChange={onChange} value={valuesGetter("voice_mail_mensagem_padrao")} type="text" className="form-control input-sm" name="voice_mail_mensagem_padrao"/>
					</div>
				</div>);
	}
}

module.exports = ConfigVoiceMailFormFields;