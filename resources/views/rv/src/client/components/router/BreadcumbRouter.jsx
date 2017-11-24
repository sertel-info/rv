import React from 'react';
import {HashRouter as Router, Route, Link, Switch, Redirect} from 'react-router-dom';
import Breadcumb from '../../../general/Breadcumb.jsx';

class BreadcumbRouter extends React.Component {
	
	constructor(props){
		super(props);
	}

	render(){
		let paths = {
			extrato : [],
			grupos : [],
			grupos_criar : [
				{name: "Grupos de Atendimento", route : "/grupos"}
			],
			grupos_editar : [
				{name: "Grupos de Atendimento", route : "/grupos"}
			],
			gravacoes : [],
			correio_voz : [],
			uras : [],
			uras_criar : [
				{name: "Uras", route : "/uras"}
			],
			uras_editar : [
				{name: "Uras", route : "/uras"}
			],
			filas : [],
			filas_criar : [
				{name: "Filas", route : "/filas"}
			],
			filas_editar : [
				{name: "Filas", route : "/filas"}
			],
			saudacoes : [],
			saudacoes_criar : [
				{name: "Saudações", route : "/saudacoes"}
			],
			saudacoes_editar : [
				{name: "Saudações", route : "/saudacoes"}
			],
			configuracoes : [],
			configuracoes_editar : [
				{name: "Configurações", route : "/configuracoes"}
			],
			notificacoes : []
		}

		return (
			<Router>
				<Switch>
					
					<Route exact path="/" children={() => <Breadcumb active="Início"/>}/>
					<Route exact path="/extrato" children={() => <Breadcumb path={paths.extrato} active="Extrato"/>}/>
					<Route exact path="/gravacoes" children={() => <Breadcumb path={paths.gravacoes} active="Gravações"/>}/>
					<Route exact path="/grupos" children={() => <Breadcumb path={paths.grupos} active="Grupos de atendimento"/>}/>
					<Route exact path="/grupos/criar" children={() => <Breadcumb path={paths.grupos_criar} active="Criar Grupo"/>}/>
					<Route exact path="/grupos/editar" children={() => <Breadcumb path={paths.grupos_editar} active="Editar Grupo"/>}/>
					<Route exact path="/uras" children={() => <Breadcumb path={paths.uras} active="Uras"/>}/>
					<Route exact path="/uras/criar" children={() => <Breadcumb path={paths.uras_criar} active="Criar Ura"/>}/>
					<Route exact path="/uras/editar" children={() => <Breadcumb path={paths.uras_editar} active="Editar Ura"/>}/>
					<Route exact path="/filas" children={() => <Breadcumb path={paths.filas} active="Filas"/>}/>
					<Route exact path="/filas/criar" children={() => <Breadcumb path={paths.filas_criar} active="Criar Fila"/>}/>
					<Route exact path="/filas/editar" children={() => <Breadcumb path={paths.filas_editar} active="Editar Fila"/>}/>
					<Route exact path="/saudacoes" children={() => <Breadcumb path={paths.saudacoes} active="Saudações"/>}/>
					<Route exact path="/saudacoes/criar" children={() => <Breadcumb path={paths.saudacoes_criar} active="Criar Saudações"/>}/>
					<Route exact path="/saudacoes/editar" children={() => <Breadcumb path={paths.saudacoes_editar} active="Editar Saudações"/>}/>
					<Route exact path="/configuracoes" children={() => <Breadcumb path={paths.configuracoes} active="Configurações"/>}/>
					<Route exact path="/configuracoes/editar" children={() => <Breadcumb path={paths.configuracoes_editar} active="Editar Configurações"/>}/>
					<Route exact path="/notificacoes" children={() => <Breadcumb path={paths.notificacoes} active="Notificações"/>}/>

				</Switch>
			</Router>
			);
	}
}

module.exports = BreadcumbRouter;