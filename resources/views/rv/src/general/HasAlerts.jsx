import React from 'react';
import Alert from './Alert.jsx';

class HasAlerts extends React.Component {
	
	constructor(props){
		super(props);

		this.props = props;
		this.state = {
			alerts: {}
		}

		this.onAlertDismiss = this.onAlertDismiss.bind(this);
		this.newAlert = this.newAlert.bind(this);
	}

	onAlertDismiss(event){
		event.preventDefault();
		let alerts = this.state.alerts;
		delete alerts[event.target.id];
		//alerts.splice(event.target.id.split('-')[1], 1);
		this.setState({alerts: alerts});
	}

	newAlert(text){
		let alerts = this.state.alerts;
		alerts.push(<Alert key={alerts.length} onDismiss={this.onAlertDismiss} text={text}/>);
		this.setState({alerts: alerts});
	}

	clearAlerts(){
		this.setState({alerts: {}});
	}

	/*
	*	recebe uma array de objectos com as propriedade type e text e cria os alerts
	*/
	newManyAlerts(alerts_arr){
		let alerts = this.state.alerts;
		alerts_arr.map(function(el){
			let id = Object.values(alerts).length;
			alerts["al-".concat(id)] = (<Alert index={id} key={id} onDismiss={this.onAlertDismiss} text={el.text} type={el.type}/>);
		}.bind(this));
		this.setState({alerts: alerts});
	}

	/*getAlerts(){
		return this.state.alerts;
	}*/
}

module.exports = HasAlerts;