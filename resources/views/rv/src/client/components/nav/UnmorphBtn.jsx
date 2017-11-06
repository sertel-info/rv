import React from 'react';
import Axios from 'axios';
import Cookies from 'universal-cookie';

class UnmorphBtn extends React.Component {
	
	constructor(props){
		super(props);
	}	

	handleUnmorph(event){
		event.preventDefault();
		
		Axios({
		
			method: "GET",
			url: _ROUTES_.client.unmorph
		
		}).then(function(response){
			
			let cookie = new Cookies();
			cookie.remove("token");
			cookie.remove("morphed");
			cookie.set("token", response.data.token);

			window.location = "/";

		}.bind(this)).catch(function(error){
			
			console.log(error);

		}.bind(this));

	}

	render(){
		
		let name = this.props.name.length >= 10 ? 
					this.props.name.substr(0, 7).concat("...") : 
					this.props.name;

		return (<div className="col-md-12">
					<a onClick={this.handleUnmorph} className="btn btn-warning btn-block">Voltar como {name}</a>
				</div>)
	}
}

module.exports = UnmorphBtn;