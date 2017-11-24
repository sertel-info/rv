import React from 'react';
import ConfigCadeadoForm from "./formfields/ConfigCadeadoForm.jsx";
import ConfigCxPostalForm from "./formfields/ConfigCxPostalForm.jsx";
import ConfigSigaMeForm from "./formfields/ConfigSigaMeForm.jsx";
import ConfigAtAutomaticoForm from "./formfields/ConfigAtAutomaticoForm.jsx";
import ConfigSaudacoesForm from "./formfields/ConfigSaudacoesForm.jsx";

class ConfigForm extends React.Component {
	
	constructor(props){
		super(props);
	}


	render(){
		/*
		*
		* Esta lógica toda não precisava estar no método render().
		* Tentei colocá-la no método componentDidMount() mas as funções
		* valuesGetter e onInputChange perdiam o contexto e paravam de funcionar;
		*/
		let onInputChange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter,
			show_inputs = this.props.show_inputs,

		cadeado_input = show_inputs.cadeado_pessoal ? <ConfigCadeadoForm
																			onInputChange={onInputChange}
																			valuesGetter={valuesGetter}/> 
																  : null,

		cx_postal_input = show_inputs.caixa_postal ? <ConfigCxPostalForm 
																			onInputChange={onInputChange}
																			valuesGetter={valuesGetter}/>
																  : null,


		siga_me_input = show_inputs.siga_me ? <ConfigSigaMeForm 
																onInputChange={onInputChange}
																valuesGetter={valuesGetter}/> :
															null,

		at_automatico_input = show_inputs.at_automatico ? <ConfigAtAutomaticoForm 
																onInputChange={onInputChange}
																valuesGetter={valuesGetter}/> :
															null,

		saudacoes_input = show_inputs.saudacoes ? <ConfigSaudacoesForm 
																onInputChange={onInputChange}
																valuesGetter={valuesGetter}/> :
															null;
		
		let all_inputs = [cadeado_input, 
						  cx_postal_input, 
						  siga_me_input, 
						  at_automatico_input,
						  saudacoes_input];

		let valid_inputs = all_inputs.filter((input, i) => {
			return input !== null;
		});

		let formated_inputs = valid_inputs;
		
		for(let i=1; i< valid_inputs.length; i++){
			formated_inputs.splice(i, 0, <div className="col-lg-12"><hr/></div>);
			i++;
		}

		return (<div className="row col-lg-12">
					{formated_inputs.map((el, idx)=>{
											return React.cloneElement(el, {key : idx})
										})
					}
				</div>);
	}
}

module.exports = ConfigForm;