import React from 'react';
import NotifBasicoFormFields from './formfields/NotifBasicoFormFields.jsx';
import NotifEmailFormFields from './formfields/NotifEmailFormFields.jsx';
import MultiForm from '../../../general/MultiForm.jsx';

class NotificacoesForm extends React.Component {
	
	constructor(props){
		super(props);
	}

	render(){
		let valuesGetter = this.props.valuesGetter,
			onInputChange = this.props.onInputChange,
			mf_stages = [
							{title:"Notificação", content:<NotifBasicoFormFields onInputChange={onInputChange} valuesGetter={valuesGetter}/>},
							{title:"Email", content:<NotifEmailFormFields onInputChange={onInputChange} valuesGetter={valuesGetter}/>}
						];

		return (<MultiForm stages={mf_stages}/>);
	}
}

module.exports = NotificacoesForm;