import React from 'react';
import UrasOptionsForm from './UrasOptionsForm.jsx';
import AudioPlayer from '../../../general/AudioPlayer.jsx';
import Axios from 'axios';
import UrasEditAudioInput from './UrasEditAudioInput.jsx';

class UrasEditForm extends React.Component {
	
	constructor(props){
		super(props);
	}

	render(){

		let onChange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;


		return (<div>
					<div className="col-lg-6">
						<div className="form-group">
							<label>Nome</label>
							<input type="text" onChange={onChange} value={valuesGetter("nome")} name="nome" className="form-control"/>
						</div>
						<UrasEditAudioInput ura_id={this.props.ura_id} onInputChange={onChange}/>
					</div>
					<div className="form-group col-lg-12 mt-5">
						<div className="">
							<label>Ações</label>
						</div>
					</div>
					<UrasOptionsForm onInputChange={onChange} valuesGetter={valuesGetter}/>
				</div>);
	}
}

module.exports = UrasEditForm;