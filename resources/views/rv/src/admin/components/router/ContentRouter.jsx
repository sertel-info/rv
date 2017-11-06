import React from 'react';
import {HashRouter as Router, Route, Link} from 'react-router-dom';
import HomeIndex from '../home/HomeIndex.jsx';
import LinhasIndex from '../linhas/LinhasIndex.jsx';
import LinhasCreate from '../linhas/LinhasCreate.jsx';
import LinhasEdit from '../linhas/LinhasEdit.jsx';
import AssinantesIndex from '../assinantes/AssinantesIndex.jsx';
import AssinantesCreate from '../assinantes/AssinantesCreate.jsx';
import AssinantesEdit from '../assinantes/AssinantesEdit.jsx';
import PlanosCreate from '../planos/PlanosCreate.jsx';
import PlanosIndex from '../planos/PlanosIndex.jsx';
import PlanosEdit from '../planos/PlanosEdit.jsx';
import NotificacoesFlashCreate from '../assinantes/NotificacoesFlashCreate.jsx';
import CreditosIndex from '../assinantes/CreditosIndex.jsx';
import ConfiguracoesIndex from '../configuracoes/ConfiguracoesIndex.jsx';
import NotificacoesIndex from '../notificacoes/NotificacoesIndex.jsx';
import NotificacoesEdit from '../notificacoes/NotificacoesEdit.jsx';
import NotificacoesCreate from '../notificacoes/NotificacoesCreate.jsx';

class ContentRouter extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		return (
				<Router>
					<div>
						<Route exact path="/" component={HomeIndex}/>
						<Route exact path="/linhas" component={LinhasIndex}/>
						<Route exact path="/linhas/criar" component={LinhasCreate}/>
						<Route exact path="/linhas/editar" component={LinhasEdit}/>
						<Route exact path="/assinantes" component={AssinantesIndex} />
						<Route exact path="/assinantes/criar" component={AssinantesCreate} />
						<Route exact path="/assinantes/editar" component={AssinantesEdit} />
						<Route exact path="/assinantes/notificacoes/criar" component={NotificacoesFlashCreate} />
						<Route exact path="/assinantes/creditos" component={CreditosIndex} />
						<Route exact path="/planos" component={PlanosIndex} />
						<Route exact path="/planos/criar" component={PlanosCreate} />
						<Route exact path="/planos/editar" component={PlanosEdit} />
						<Route exact path="/configuracoes" component={ConfiguracoesIndex} />
						<Route exact path="/notificacoes" component={NotificacoesIndex} />
						<Route exact path="/notificacoes/criar" component={NotificacoesCreate} />
						<Route exact path="/notificacoes/editar" component={NotificacoesEdit} />
					</div>
				</Router>
				);
	}
}

module.exports = ContentRouter;