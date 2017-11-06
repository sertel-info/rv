import React from 'react';

class NotificacoesEmailFormFields extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		return (<div className="col-lg-6">
						<h3>Em manutenção</h3>
						{/*<div className="form-group">
							<label> Status </label>
							<select name="nivel" className="form-control" placeholder="">
								<option value="danger"> Ativado </option>
								<option value="warning"> Desativado </option>
							</select>
						</div>
						<div className="form-group">
							<label> Título </label>
							<input type="text" name=""/> 
						</div>
						<div className="form-group">
							<label> Texto </label>
							<input type="text" name=""/> 
						</div>*/}
				</div>);
	}
}

module.exports = NotificacoesEmailFormFields;