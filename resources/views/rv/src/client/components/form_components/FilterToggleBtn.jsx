import React from 'react';
import Modal from '../../../general/Modal.jsx';
import PanelToggleBtn from '../../../general/PanelToggleBtn.jsx';

class FilterToggleBtn extends React.Component {
	
	constructor(props){
		super(props);
		this.state = {
			toggle : false,
		}

		this.handleClick = this.handleClick.bind(this);
		this.getContentModal = this.getContentModal.bind(this);
	}


	handleClick(event){
		event.preventDefault();
		this.setState({toggle: !this.state.filter_toggled});
	}


	getContentModal(){
		if(!this.state.toggle)
			return null;

		return <Modal content={this.props.content} 
						title={this.props.title}
						cancelable={true}
						cancelLabel="Voltar"
						confirmable={false}
						onConfirm={()=> {this.props.onConfirm(); this.setState({toggle:false})}}
						show={true}
						customBtns={this.props.customBtns}
						onHide={ () => {this.setState({toggle: false})} }
						/>
	}


	render(){
		return (<div className="pull-right">
					<PanelToggleBtn onClick={this.handleClick} state={this.state.toggle}/>
					{this.getContentModal()}
				</div>)
	}
}

module.exports = FilterToggleBtn;