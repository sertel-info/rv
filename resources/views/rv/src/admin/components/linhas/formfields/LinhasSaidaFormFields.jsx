import React from 'react';
import PickList from '../../../../general/PickList.jsx';

class LinhasSaidaFormFields extends React.Component {
	
	constructor(props){
		super(props);

		this.state = {
			rotas : [
					    {value:"EBS", title: 'EBS' },
                        {value:"liguetelecom", title: 'liguetelecom' },
                        {value:"falemais_sem_cli", title: 'falemais_sem_cli' },
                        {value:"falemais_com_cli", title: 'falemais_com_cli' },
                        {value:"gti", title: 'gti' },
                        {value:"bft", title: 'bft' },
			]
		}
	}
					
	render(){
		return (<PickList name="rotas_saida" onChange={this.props.onInputChange} value={this.props.valuesGetter("rotas_saida")} options={this.state.rotas}/>);
	}
}

module.exports = LinhasSaidaFormFields;