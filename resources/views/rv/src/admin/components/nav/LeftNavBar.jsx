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
							<LeftNavBarButton href="/linhas" icon="fa-phone" text="Linhas"/>
							<LeftNavBarButton href="/assinantes" icon="fa-user" text="Assinantes"/>
							<LeftNavBarButton href="/planos" icon="fa-dollar" text="Planos"/>
							<LeftNavBarButton href="/notificacoes" icon="fa-quote-right" text="Notificacoes"/>
							<LeftNavBarButton href="/configuracoes" icon="fa-gears" text="Configurações"/>
							{/*<li className="parent "><a data-toggle="collapse" href="#sub-item-1">
								<em className="fa fa-navicon">&nbsp;</em> Multilevel <span data-toggle="collapse" href="#sub-item-1" className="icon pull-right"><em className="fa fa-plus"></em></span>
								</a>
								<ul className="children collapse" id="sub-item-1">
									<li><a className="" href="#">
										<span className="fa fa-arrow-right">&nbsp;</span> Sub Item 1
									</a></li>
									<li><a className="" href="#">
										<span className="fa fa-arrow-right">&nbsp;</span> Sub Item 2
									</a></li>
									<li><a className="" href="#">
										<span className="fa fa-arrow-right">&nbsp;</span> Sub Item 3
									</a></li>
								</ul>
							</li>*/}
						</ul>
					</div>
						
				</div>;
	}
}

module.exports = LeftNavBar;