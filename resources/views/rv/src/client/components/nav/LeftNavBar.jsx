import React from 'react';
import LeftNavBarButton from './LeftNavBarButton.jsx';
import UserHeader from './UserHeader.jsx';

class LeftNavBar extends React.Component {
	
	constructor(props){
		super(props);
	}

	render(){
		let perms = this.props.perms;

		return <div>
					<div id="sidebar-collapse" className="col-sm-3 col-lg-2 sidebar left-navbar-scroll">
						<div className="profile-sidebar">
							<UserHeader/>
							<div className="clear"></div>
						</div>
						<div className="divider"></div>
						
						<ul className="nav menu">
							<LeftNavBarButton href="/" icon="fa-home" text="Início"/>
							{perms.gravacoes ?  <LeftNavBarButton href="/gravacoes" icon="fa-headphones " text="Gravações"/> : null}
							{perms.extrato ? <LeftNavBarButton href="/extrato" icon="fa-user" text="Extrato"/> : null}
							{perms.g_aten ? <LeftNavBarButton href="/grupos" icon="fa-users" text="Grupos de atendimento"/>: null}
							{perms.uras ? <LeftNavBarButton href="/uras" icon="fa-volume-up" text="URA"/>: null}
							{perms.filas ? <LeftNavBarButton href="/filas" icon="fa-users" text="Filas"/>: null}
							{perms.saudacoes ? <LeftNavBarButton href="/saudacoes" icon="fa-quote-left" text="Saudações"/>: null}
							{perms.correio_voz ? <LeftNavBarButton href="/correio_voz" icon="fa-quote-left" text="Correio de voz"/>: null}
							<LeftNavBarButton href="/configuracoes" icon="fa-gears" text="Configurações"/>
							<LeftNavBarButton href="/creditos" icon="fa-star" text="Adicionar Créditos"/>
						</ul>
					</div>
						
				</div>;
	}
}

module.exports = LeftNavBar;