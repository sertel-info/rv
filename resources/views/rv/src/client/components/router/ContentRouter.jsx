import React from 'react';
import {HashRouter as Router, Route, Link, Switch, Redirect} from 'react-router-dom';
import HomeIndex from '../home/HomeIndex.jsx';
import ExtratoIndex from '../extrato/ExtratoIndex.jsx';
import GruposIndex from '../grupos_atendimento/GruposIndex.jsx';
import GruposCreate from '../grupos_atendimento/GruposCreate.jsx';
import GruposEdit from '../grupos_atendimento/GruposEdit.jsx';
import GravacoesIndex from '../gravacoes/GravacoesIndex.jsx';
import UrasIndex from '../uras/UrasIndex.jsx';
import UrasCreate from '../uras/UrasCreate.jsx';
import UrasEdit from '../uras/UrasEdit.jsx';
import FilasIndex from '../filas/FilasIndex.jsx';
import FilasCreate from '../filas/FilasCreate.jsx';
import FilasEdit from '../filas/FilasEdit.jsx';
import SaudacoesIndex from '../saudacoes/SaudacoesIndex.jsx';
import SaudacoesCreate from '../saudacoes/SaudacoesCreate.jsx';
import SaudacoesEdit from '../saudacoes/SaudacoesEdit.jsx';
import ConfigIndex from '../configuracoes/ConfigIndex.jsx';
import ConfigLineEdit from '../configuracoes/ConfigLineEdit.jsx';
import CorreioVozIndex from '../correio_voz/CorreioVozIndex.jsx';
import NotificacoesIndex from '../notificacoes/NotificacoesIndex.jsx';

class ContentRouter extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let perms = this.props.perms;
		return (
				<Router>
					<Switch>
					
						<Route exact path="/" component={HomeIndex}/>
						{perms.extrato ? <Route exact path="/extrato" component={ExtratoIndex}/> : null}
						
						{perms.g_aten ? [<Route key="1" exact path="/grupos" component={GruposIndex}/>,
										 <Route key="2" exact path="/grupos/criar" component={GruposCreate}/>,
										 <Route key="3" exact path="/grupos/editar" component={GruposEdit}/>]
									  : null}

						{perms.gravacoes ? <Route exact path="/gravacoes" component={GravacoesIndex}/> : null}
		
						{perms.correio_voz ? <Route exact path="/correio_voz" component={CorreioVozIndex}/> : null }

						{perms.uras ? [<Route key="1" exact path="/uras" component={UrasIndex}/>,
										<Route key="2" exact path="/uras/criar" component={UrasCreate}/>,
										<Route key="3" exact path="/uras/editar" component={UrasEdit}/>]
									: null}
						
						{perms.filas ? [<Route key="1" exact path="/filas" component={FilasIndex}/>,
										<Route key="2" exact path="/filas/criar" component={FilasCreate}/>,
										<Route key="3" exact path="/filas/editar" component={FilasEdit}/>]
									 : null}

						{perms.saudacoes ? [<Route key="1" exact path="/saudacoes" component={SaudacoesIndex}/>,
											<Route key="2" exact path="/saudacoes/criar" component={SaudacoesCreate}/>,
											<Route key="3" exact path="/saudacoes/editar" component={SaudacoesEdit}/>]
										: null}

						<Route exact path="/configuracoes" component={ConfigIndex}/>
						<Route exact path="/configuracoes/editar" component={ConfigLineEdit}/>
						<Route exact path="/notificacoes" component={NotificacoesIndex}/>

						{/* Se a rota for desconhecida, redireciona para a home*/}
						<Route children={ (match)=> { return <Redirect to="/"/>; } }/>
					</Switch>
				</Router>
				);
	}
}

module.exports = ContentRouter;