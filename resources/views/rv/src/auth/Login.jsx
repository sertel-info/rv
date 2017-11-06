import React from 'react';
import Axios from 'axios';
import HasAlerts from '../general/HasAlerts.jsx';
import Cookies from 'universal-cookie';

class Login extends HasAlerts {
	
	constructor(props){
		super(props);

		this.state = {
			password : "",
			email : "",
			alerts : {}
		}

		this.handlePasswordChange = this.handlePasswordChange.bind(this);
		this.handleEmailChange = this.handleEmailChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
	}

	validateToken(){
		Axios({
			
			method:"POST",
			url:_ROUTES_.auth.signin,
			data: {
				email: this.state.email,
				password: this.state.password
			}

		})
	}

	handleSubmit(event){
		event.preventDefault();
		Axios({
			
			method:"POST",
			url:_ROUTES_.auth.signin,
			data: {
				email: this.state.email,
				password: this.state.password
			}

		}).then(function(response){
			
			let cookie = new Cookies();
			cookie.set("token", response.data.token);
			window.location = "/";

		}.bind(this)).catch(function(error){

			this.clearAlerts();
			let response = error.response,
				alerts = [];

			if(response.status == 400){
				let errors = response.data.errors;
				
				if(errors != undefined){
					errors.map(function(er){
						alerts.push({type:"danger", "text":er});
					}.bind(alerts));
				}
				
				this.newManyAlerts(alerts);
				return;
			}

			alerts.push({type:"danger", text:"Um erro inesperado ocorreu, por favor tente novamente"});
			this.newManyAlerts(alerts);

		}.bind(this));
	}

	handlePasswordChange(event){
		event.preventDefault();
		this.setState({password : event.target.value});
	}

	handleEmailChange(event){
		event.preventDefault();
		this.setState({email: event.target.value});
	}

	render(){

		return (<div className="row">
				<div className="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
					<div className="panel-heading login-brand">						
						<p className="brand">RAMAL<span>VIRTUAL</span></p>
					</div>
					<div className="login-panel panel panel-default">
						<div className="panel-heading">Login</div>
						<div className="panel-body">
							{
								Object.values(this.state.alerts).map(function(al){
									return al
								})
							}
							<form role="form" onSubmit={this.handleSubmit}>
								<fieldset>
									<div className="form-group">
										<input onChange={this.handleEmailChange} value={this.state.email} className="form-control" placeholder="Email" name="email" type="email" autoFocus=""/>
									</div>
									<div className="className-group">
										<input onChange={this.handlePasswordChange} value={this.state.password} className="form-control" placeholder="Senha" name="password" type="password"/>
									</div>
									<div style={{marginTop:"6px"}}><button className="btn btn-primary mt-3">Entrar</button></div>
								</fieldset>
							</form>
						</div>
						<div className="panel-footer"><center><img src="/img/logo-sertel.png"></img></center></div>
					</div>
				</div>
			</div>)
	}
}

module.exports = Login;
