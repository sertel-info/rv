import React from 'react';
import {HashRouter as Router, Route, Link, Switch, Redirect} from 'react-router-dom';
import Breadcumb from '../../../general/Breadcumb.jsx';

class BreadcumbRouter extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let paths = {
			linhas : [],
			linhas_criar : [
				{name : "Linhas", route: "/linhas"}
			],
			linhas_editar : [
				{name : "Linhas", route: "/linhas"}
			],
			assinantes : [],
			assinantes_criar : [
				{name : "Assinantes", route: "/assinantes"}
			],
			assinantes_editar : [
				{name : "Assinantes", route: "/assinantes"}
			],
			assinantes_notificacoes_criar : [
				{name : "Assinantes", route: "/assinantes"}
			],
			assinantes_creditos : [
				{name : "Assinantes", route: "/assinantes"}
			],
			planos : [],
			planos_criar : [
				{name : "Planos", route: "/planos"}
			],
			planos_editar : [
				{name : "Planos", route: "/planos"}
			],
			configuracoes : [],
			notificacoes : [],
			notificacoes_criar : [
				{name : "Notificações", route: "/notificacoes"}
			],
			notificacoes_editar : [
				{name : "Notificações", route: "/notificacoes"}
			],
			
		}

		return (
				<Router>
					<Switch>
						
						<Route exact path="/" children={() => <Breadcumb active="Início"/>}/>
						<Route exact path="/linhas" children={() => <Breadcumb path={paths.linhas} active="Linhas"/>}/>
						<Route exact path="/linhas/criar" children={() => <Breadcumb path={paths.linhas_criar} active="Criar Linha"/>}/>
						<Route exact path="/linhas/editar" children={() => <Breadcumb path={paths.linhas_editar} active="Editar Linha"/>}/>
						<Route exact path="/assinantes" children={() => <Breadcumb path={paths.assinantes} active="Assinantes"/>}/>
						<Route exact path="/assinantes/criar" children={() => <Breadcumb path={paths.assinantes_criar} active="Criar Assinante"/>}/>
						<Route exact path="/assinantes/editar" children={() => <Breadcumb path={paths.assinantes_editar} active="Editar Assinante"/>}/>
						<Route exact path="/assinantes/notificacoes/criar" children={() => <Breadcumb path={paths.assinantes_notificacoes_criar} active="Criar notificação"/>}/>
						<Route exact path="/assinantes/creditos" children={() => <Breadcumb path={paths.assinantes_creditos} active="Atualizar Créditos do Assinante"/>}/>
						<Route exact path="/planos" children={() => <Breadcumb path={paths.planos} active="Planos"/>}/>
						<Route exact path="/planos/criar" children={() => <Breadcumb path={paths.planos_criar} active="Criar Planos"/>}/>
						<Route exact path="/planos/editar" children={() => <Breadcumb path={paths.planos_editar} active="Editar Planos"/>}/>
						<Route exact path="/configuracoes" children={() => <Breadcumb path={paths.configuracoes} active="Configurações"/>}/>
						<Route exact path="/notificacoes" children={() => <Breadcumb path={paths.notificacoes} active="Notificações"/>}/>
						<Route exact path="/notificacoes/criar" children={() => <Breadcumb path={paths.notificacoes_criar} active="Criar Notificação"/>}/>
						<Route exact path="/notificacoes/editar" children={() => <Breadcumb path={paths.notificacoes_editar} active="Editar Notificação"/>}/>

					</Switch>
			</Router>

				);
	}
}

module.exports = BreadcumbRouter;