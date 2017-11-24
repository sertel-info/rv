import React from 'react';
import Axios from 'axios';

class CheckAsReadBtn extends React.Component {
	
	constructor(props){
		super(props);

		this.state = {
			loading : false,
			already_marked : false
		}

		this.markAsRead = this.markAsRead.bind(this);
		this.handleMarkClick = this.handleMarkClick.bind(this);
	}	

	markAsRead(){
		Axios({
			
			method: "POST",
			url: _ROUTES_.notificacoes.mark,
			params : {notf: this.props.notf,
					  is_flash : this.props.is_flash}

		}).then(function(response){
			
			this.setState({loading: false, already_marked : true});

		}.bind(this)).catch(function(error){
			
			console.log(error);

		}.bind(this));
	}

	handleMarkClick(event){
		event.preventDefault();
		this.setState({loading: true});
		this.markAsRead();
	}

	render(){
		if(this.state.loading)
			return <div><img src="img/sertel-loading.gif" className="loading-xs"/></div>

		if(this.state.already_marked){
			return <div>
						<p className="text-success"> <i className="fa fa-check"></i> Marcada como lida </p>
					</div>
		}

		return (<div>
					<a href="#" onClick={this.handleMarkClick}> <i className="fa fa-check"></i> Marcar como lida </a>
				</div>);
	}
}

module.exports = CheckAsReadBtn;