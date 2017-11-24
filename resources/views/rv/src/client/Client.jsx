import React from 'react';
import TopNavBar from './components/nav/TopNavBar.jsx';
import LeftNavBar from './components/nav/LeftNavBar.jsx';
import Breadcumb from '../general/Breadcumb.jsx';
import ContentRouter from './components/router/ContentRouter.jsx';
import BreadcumbRouter from './components/router/BreadcumbRouter.jsx';
import Axios from 'axios';

class Client extends React.Component {
	
	constructor(props){
		super(props);
		
		this.state = {
			permissions : {
				correio_voz:0,
				extrato:0,
				filas:0,
				g_aten:0,
				gravacoes:0,
				saudacoes:0,
				uras:0
			}
		}
	}

	componentDidMount(){
		
		Axios({
			
			method: "GET",
			url: _ROUTES_.client.get_user_perms

		}).then(function(response){
			
			this.setState({
				permissions : response.data.perms
			});

		}.bind(this)).catch(function(error){
			
			console.log(error);

		}.bind(this));

	}

	render(){

		return (<div>
					<TopNavBar/>
					<LeftNavBar perms={this.state.permissions}/>
					<div className="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
						<BreadcumbRouter/>
						<div className="container-fluid">
							<ContentRouter perms={this.state.permissions}/>
						</div>
					</div>
				</div>);
	}
}

module.exports = Client;