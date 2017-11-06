import HasAlerts from '../general/HasAlerts.jsx';
import React from 'react';
import Axios from 'axios';

class Register extends HasAlerts {
	
	constructor(props){
		super(props);
		this.state = {
			"password" : "",
			"email" : "",
			"name" : "",
			"password_confirm" : "",
			"alerts": {}
		};

		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
	}

	handleSubmit(event){
		event.preventDefault();
		alert(_ROUTES_.auth.signup);
		Axios({
			
			method:"POST",
			url:_ROUTES_.auth.signup,
			data: {
				name: this.state.name,
				password: this.state.password,
				email: this.state.email,
				password_confirm: this.state.password_confirm
			}

		}).then(function(response){

		}).catch(function(error){
			
			//this.clearAlerts();
			let response = error.response;

			if(response.status == 400){
				let alerts = [],
					validation_errors = response.data.validation_errors;
				
				for(error in validation_errors){
					validation_errors[error].map(function(el){
						alerts.push({type:"danger", text:el});
					}.bind(alerts));
				}

				this.newManyAlerts(alerts);
			}

		}.bind(this));
	}

	handleInputChange(event){
		event.preventDefault();
		let new_state = {};
		new_state[event.target.name] = event.target.value;
		this.setState(new_state);
	}

	render(){
		return (<div className="row">
				<div className="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
					<div className="panel-heading login-brand">						
						<p className="brand">RAMAL<span>VIRTUAL</span></p>
					</div>
					<div className="login-panel panel panel-default">
						<div className="panel-heading">Registrar</div>
						<div className="panel-body">
							{
								Object.values(this.state.alerts).map(function(al){
									return al
								})
							}
							<form role="form" action="#" onSubmit={this.handleSubmit}>
								<fieldset>
									<div className="form-group">
										<input onChange={this.handleInputChange} value={this.state.name} className="form-control" placeholder="Nome" name="name" type="text" autoFocus=""/>
									</div>
									<div className="form-group">
										<input onChange={this.handleInputChange} value={this.state.email} className="form-control" placeholder="Email" name="email" type="email"/>
									</div>
									<div className="form-group">
										<input onChange={this.handleInputChange} value={this.state.password} className="form-control" placeholder="Senha" name="password" type="password"/>
									</div>
									<div className="form-group">
										<input onChange={this.handleInputChange} value={this.state.password_confirm} className="form-control" placeholder="Confirme a senha" name="password_confirm" type="password"/>
									</div>
									<div style={{marginTop:"6px"}}><button className="btn btn-primary mt-3">Registrar</button></div>
								</fieldset>
							</form>
						</div>
						<div className="panel-footer"><center><img src="/img/logo-sertel.png"></img></center></div>
					</div>
				</div>
			  </div>);
	}
}

module.exports = Register;