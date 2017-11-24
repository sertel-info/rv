import React from 'react';
import AudioPlayer from '../../../general/AudioPlayer.jsx';
import Modal from '../../../general/Modal.jsx';

class ListenBtn extends React.Component {
	
	constructor(props){
		super(props);

		this.state = {
			show_player : false
		}

		this.getPlayer = this.getPlayer.bind(this);
		this.handleClick = this.handleClick.bind(this);
	}

	handleClick(event){
		event.preventDefault();
		this.setState({show_player:true});
	}


	getPlayer(){
		let content = <AudioPlayer src={this.props.src} className="player full-width"/>;
		
		return <Modal 
					show={true} 
					content={content} 
					title=""
					cancelable={false}
					confirmable={true}
					onConfirm = {() => {this.setState({show_player:false})}}
					confirmLabel="Voltar"
					/>
	}

	render(){
		let player = this.state.show_player ? this.getPlayer() : '';

		return (<div className="pull-left mr-2">
					<a href="#" onClick={this.handleClick} className={this.props.className}><i className="fa fa-headphones"/> ouvir </a>
					{player}
				</div>
				);
	}
}

module.exports = ListenBtn;