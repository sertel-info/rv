import React from 'react';
import MultiForm from '../../../general/MultiForm.jsx';
import LinhasBasicoFormFields from './formfields/LinhasBasicoFormFields.jsx';
import LinhasAutenticacaoFormFields from './formfields/LinhasAutenticacaoFormFields.jsx';
import LinhasDidFormFields from './formfields/LinhasDidFormFields.jsx';
import LinhasCodecsFormFields from './formfields/LinhasCodecsFormFields.jsx';
import LinhasSaidaFormFields from './formfields/LinhasSaidaFormFields.jsx';
import LinhasConfiguracoesFormFields from './formfields/LinhasConfiguracoesFormFields.jsx';
import LinhasFacilidadesFormFields from './formfields/LinhasFacilidadesFormFields.jsx';
import LinhasPermissoesFormFields from './formfields/LinhasPermissoesFormFields.jsx';


class LinhasForm extends React.Component {
	
	constructor(props){
		super(props);
		this.props = props;
	}

	render(){
		
		let onInputChangeCallback = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter,
			stages = [
						 {title: "Básico",content: <LinhasBasicoFormFields onInputChange={onInputChangeCallback} valuesGetter={valuesGetter}/>},
						 {title: "Autenticação", content: <LinhasAutenticacaoFormFields onInputChange={onInputChangeCallback} valuesGetter={valuesGetter}/>},
						 {title: "DID", content: <LinhasDidFormFields onInputChange={onInputChangeCallback} valuesGetter={valuesGetter}/>},
						 {title: "Codecs", content: <LinhasCodecsFormFields onInputChange={onInputChangeCallback} valuesGetter={valuesGetter}/>},
						 {title: "Saída", content: <LinhasSaidaFormFields onInputChange={onInputChangeCallback} valuesGetter={valuesGetter}/>},
						 {title: "Configurações", content: <LinhasConfiguracoesFormFields onInputChange={onInputChangeCallback} valuesGetter={valuesGetter}/>},
						 {title: "Facilidades", content: <LinhasFacilidadesFormFields onInputChange={onInputChangeCallback} valuesGetter={valuesGetter}/>},
						 {title: "Permissões", content: <LinhasPermissoesFormFields onInputChange={onInputChangeCallback} valuesGetter={valuesGetter}/>},
					 ];

		return (<MultiForm 
						stages={stages}
				/>);
	}
}

module.exports = LinhasForm;