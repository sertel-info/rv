import React from 'react';
import LeftNavBarButton from './LeftNavBarButton.jsx';
import UserHeader from './UserHeader.jsx';

class LeftNavBar extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		return <div>
					<div id="sidebar-collapse" className="col-sm-3 col-lg-2 sidebar">
						<div className="profile-sidebar">
							<UserHeader/>
							<div className="clear"></div>
						</div>
						<div className="divider"></div>
						
						<ul className="nav menu">
							<LeftNavBarButton href="/" icon="fa-home" text="Início"/>
							<LeftNavBarButton href="/gravacoes" icon="fa-headphones " text="Gravações"/>
							<LeftNavBarButton href="/extrato" icon="fa-user" text="Extrato"/>
							<LeftNavBarButton href="/grupos" icon="fa-users" text="Grupos de atendimento"/>
							<LeftNavBarButton href="/ura" icon="fa-volume-up" text="URA"/>
							<LeftNavBarButton href="/filas" icon="fa-users" text="Filas"/>
							<LeftNavBarButton href="/saudacoes" icon="fa-quote-left" text="Saudações"/>
							<LeftNavBarButton href="/configuracoes" icon="fa-gears" text="Configurações"/>
							<LeftNavBarButton href="/creditos" icon="fa-star" text="Adicionar Créditos"/>
							
						</ul>
					</div>
						
				</div>;
	}
}

module.exports = LeftNavBar;