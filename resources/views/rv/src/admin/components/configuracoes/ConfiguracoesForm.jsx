import React from 'react';
import MultiForm from '../../../general/MultiForm.jsx';
import ConfigGeralFormFields from './formfields/ConfigGeralFormFields.jsx';
import ConfigVoiceMailFormFields from './formfields/ConfigVoiceMailFormFields.jsx';

class ConfiguracoesForm extends React.Component {
	
	constructor(props){
		super(props);
	}

	render(){
		let onChange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;

		return (<MultiForm stages={[
									{"title": "Geral", "content": <ConfigGeralFormFields valuesGetter={valuesGetter} onInputChange={onChange}/>},
									{"title": "Voice Mail", "content": <ConfigVoiceMailFormFields valuesGetter={valuesGetter} onInputChange={onChange}/>},
								  ]}
				/>);
	}
}

module.exports = ConfiguracoesForm;