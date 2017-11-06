import React from 'react';
import {HashRouter as Router, Route, Link} from 'react-router-dom';
import HomeIndex from '../home/HomeIndex.jsx';
import ExtratoIndex from '../extrato/ExtratoIndex.jsx';
import GruposIndex from '../grupos_atendimento/GruposIndex.jsx';
import GruposCreate from '../grupos_atendimento/GruposCreate.jsx';
import GruposEdit from '../grupos_atendimento/GruposEdit.jsx';
import GravacoesIndex from '../gravacoes/GravacoesIndex.jsx';

class ContentRouter extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		return (
				<Router>
					<div>
						
						<Route exact path="/" component={HomeIndex}/>
						<Route exact path="/extrato" component={ExtratoIndex}/>
						<Route exact path="/grupos" component={GruposIndex}/>
						<Route exact path="/grupos/criar" component={GruposCreate}/>
						<Route exact path="/grupos/editar" component={GruposEdit}/>
						<Route exact path="/gravacoes" component={GravacoesIndex}/>

					</div>
				</Router>
				);
	}
}

module.exports = ContentRouter;