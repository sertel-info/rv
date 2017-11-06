import React from 'react';

class PanelToggleBtn extends React.Component {
	
	constructor(props){
		super(props);

		//false significa que está "fechado"
		this.state = {
			state : this.props.state !== undefined ? this.props.state : false
		}
	}

	componentWillReceiveProps(nextProps){
		this.setState({state : nextProps.state})
	}

	render(){
		let icon = this.state.state ? "fa fa-search-minus" : "fa fa-search-plus";
		return (<span onClick={this.props.onClick} className="pull-right clickable btn btn-warning"><em className={icon}></em> Filtrar </span>);
	}
}

module.exports = PanelToggleBtn;