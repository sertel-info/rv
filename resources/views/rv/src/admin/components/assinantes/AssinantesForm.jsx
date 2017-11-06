import React from 'react';
import MultiForm from '../../../general/MultiForm.jsx';
import AssinantesBasicoFormFields from './formfields/AssinantesBasicoFormFields.jsx';
import AssinantesContatoFormFields from './formfields/AssinantesContatoFormFields.jsx';
import AssinantesFinanceiroFormFields from './formfields/AssinantesFinanceiroFormFields.jsx';
import AssinantesFacilidadesFormFields from './formfields/AssinantesFacilidadesFormFields.jsx';
import AssinantesAcessoFormFields from './formfields/AssinantesAcessoFormFields.jsx';

class AssinantesForm extends React.Component {
	
	constructor(props){
		super(props);
		
	}

	render(){
		let onInputChangeCallback = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;

		let stages = [
						 {title: "Básico", content: <AssinantesBasicoFormFields  onInputChange={onInputChangeCallback} valuesGetter={valuesGetter}/>},
						 {title: "Contato", content: <AssinantesContatoFormFields onInputChange={onInputChangeCallback} valuesGetter={valuesGetter}/>},
						 {title: "Financeiro", content: <AssinantesFinanceiroFormFields onInputChange={onInputChangeCallback} valuesGetter={valuesGetter}/>},
						 {title: "Facilidades", content: <AssinantesFacilidadesFormFields onInputChange={onInputChangeCallback} valuesGetter={valuesGetter}/>},
						 {title: "Acesso", content: <AssinantesAcessoFormFields onInputChange={onInputChangeCallback} valuesGetter={valuesGetter}/>},
					 ];

		return (<MultiForm 
						stages={stages}
				/>);
	}
}

module.exports = AssinantesForm;