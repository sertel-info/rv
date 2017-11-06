import React from 'react';
import Axios from 'axios';

class UserHeader extends React.Component {
	
	constructor(props){
		super(props);
		this.state = {
			is_loading : true,
			username : ""
		}
	}

	componentDidMount(){
		Axios({
			
			method: "GET",
			url: _ROUTES_.dashboard.get_admin_header_data

		}).then(function(response){

			this.setState({
				username : response.data.username
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

		let username = this.state.username.charAt(0).toUpperCase() + this.state.username.slice(1);
		return (<div className="profile-usertitle">
					<div className="col-md-2"/>
					<div className="col-md-8">
						<div className="profile-usertitle-name">
						{username}
						</div>
						<div className="profile-usertitle-status">
							<span className="indicator label-success"></span>ADMIN
						</div>
					</div>
					<div className="col-md-2"/>
					
				</div>);
	}
}

module.exports = UserHeader;