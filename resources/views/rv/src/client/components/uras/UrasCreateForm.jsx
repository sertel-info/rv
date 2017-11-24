import React from 'react';
import UrasOptionsForm from './UrasOptionsForm.jsx';
import AudioPlayer from '../../../general/AudioPlayer.jsx';
import Axios from 'axios';

class UrasForm extends React.Component {
	
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
						
						<div className="form-group">
								<label>Arquivo de Áudio</label>
								<input type="file" onChange={onChange} name="arquivo_audio"/>
								<p className="help-block">O arquivo precisa ter o formato wav</p>
						</div>
						
					</div>
					<div className="form-group col-lg-12">
						<div className="">
							<label>Ações</label>
						</div>
					</div>
					<UrasOptionsForm onInputChange={onChange} valuesGetter={valuesGetter}/>
				</div>);
	}
}

module.exports = UrasForm;