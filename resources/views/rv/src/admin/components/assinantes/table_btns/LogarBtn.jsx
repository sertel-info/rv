import React from 'react';
import Axios from 'axios';
import Cookies from 'universal-cookie';

class LogarBtn extends React.Component {
	
	constructor(props){
		super(props);
		this.handleClick = this.handleClick.bind(this);
	}

	
	handleClick(event){
		event.preventDefault();
		
		Axios({

			method: "GET",
			url: _ROUTES_.assinantes.morph,
			params : {id : this.props.user}

		}).then(function(response){

			let cookie = new Cookies();
			cookie.set("token", response.data.token);
			cookie.set("morphed", response.data.morphed);
			window.location = "/";

		}.bind(this)).catch(function(error){
			
			console.log(error);
		
		}.bind(this));
	}


	render(){
		return (
				<a href="#" 
				   onClick={this.handleClick} 
				   className="btn btn-xs btn-primary"> 

				   <em className="fa fa-user fa-2x" aria-hidden="true"/> Logar </a>
				);
	}
}

module.exports = LogarBtn;