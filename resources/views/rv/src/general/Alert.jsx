import React from 'react';

class Alert extends React.Component {
	
	constructor(props){
		super(props);

		this.props = props;
	}

	render(){
		return (<div className={"alert bg-"+this.props.type} role="alert">
					<em className={(this.props.icon !== undefined ? this.props.icon : "fa fa-exclamation-triangle")}>&nbsp;</em> 
						{this.props.text}
					 <a href="#" onClick={this.props.onDismiss} className="pull-right"><em id={"al-"+this.props.index} className="fa fa-lg fa-close"></em></a>
				</div>);
	}
}

module.exports = Alert;