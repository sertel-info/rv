import React from 'react';
import Axios from 'axios';
import UnmorphBtn from './UnmorphBtn.jsx';

class UserHeader extends React.Component {
	
	constructor(props){
		super(props);
		this.state = {
			is_loading : true,
			username : "",
			credits : 0.00,
			morphed : null,
			morphed_name : null
		}
	}

	componentDidMount(){
		Axios({
			
			method: "GET",
			url: _ROUTES_.client.get_cli_header_data

		}).then(function(response){

			this.setState({
				username : response.data.username,
				credits : response.data.credits,
				morphed : response.data.morphed,
				morphed_name : response.data.morphed_name
			});

			this.setState({is_loading: false});

		}.bind(this)).catch(function(error){
			
			console.log(error);

		}.bind(this));

	}

	render(){
		if(this.state.is_loading){
			return (<div className="profile-usertitle">
						<div className="col-md-2"/>
						<div className="col-md-8">
							<img className="loading" src="/img/sertel-loading.gif"/>
						</div>
						<div className="col-md-2"/>
					</div>)
		}

		return (<div className="profile-usertitle">
					<div className="col-md-2"/>
					<div className="col-md-8">
						<div className="profile-usertitle-name">{this.state.username}</div>
						<div className="profile-usertitle-status">
							<span className="indicator label-success"></span>{"R$ ".concat(this.state.credits)}
						</div>
					</div>
					<div className="col-md-2"/>
					{this.morphed !== null ? <UnmorphBtn name={this.state.morphed_name}/> : "" }
					
				</div>);
	}
}

module.exports = UserHeader;