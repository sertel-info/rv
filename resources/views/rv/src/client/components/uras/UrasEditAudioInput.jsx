import React from 'react';
import AudioPlayer from '../../../general/AudioPlayer.jsx';

class UrasEditAudioInput extends React.Component {
	
	constructor(props){
		super(props);

		this.state = {
			is_editing : false
		}

		this.TurnOffEditing = this.TurnOffEditing.bind(this);
		this.TurnOnEditing = this.TurnOnEditing.bind(this);
	}

	TurnOnEditing(){
		this.setState({is_editing: true});
	}

	TurnOffEditing(){
		this.setState({is_editing: false});
	}

	render(){
		if(this.state.is_editing){
			return (
				<div className="form-group">
					<label>Arquivo de Áudio</label>
					<input type="file" onChange={this.props.onInputChange} name="arquivo_audio"/>
					<p className="help-block">O arquivo precisa ter o formato wav</p>
					<div className="mt-2">
						<a onClick={this.TurnOffEditing} className="btn btn-warning"> <i className="fa fa-times"/> Cancelar </a>
					</div>
				</div>
				);
		}

		return <div className="form-group">
					<label>Áudio</label>
					<AudioPlayer src={_ROUTES_.uras.get_audio.concat("?u=",this.props.ura_id)} className="col-lg-12"/>
					<div className="col-lg-12 mt-2">
						<a onClick={this.TurnOnEditing} className="btn btn-warning"> <i className="fa fa-refresh"/> Alterar áudio </a>
					</div>
				</div>
		
	}
}

module.exports = UrasEditAudioInput;