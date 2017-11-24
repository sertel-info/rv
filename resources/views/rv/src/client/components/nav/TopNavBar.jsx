import React from 'react';
import NotifBtn from '../notificacoes/NotifBtn.jsx';

class TopNavBar extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		return (<nav className="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div className="container-fluid">
			<div className="navbar-header">
				<button type="button" className="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span className="sr-only">Toggle navigation</span>
					<span className="icon-bar"></span>
					<span className="icon-bar"></span>
					<span className="icon-bar"></span></button>
				<a className="navbar-brand" href="#">RAMAL<span>VIRTUAL</span></a>
				<ul className="nav navbar-top-links navbar-right">
					<NotifBtn />
				
					<li className='dropdown'>
						<a className="dropdown-toggle count-info" href="/signout" style={{width:"auto"}}>
							<span> <em className="fa fa-power-off"></em> Sair</span> 
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>);
	}
}

module.exports = TopNavBar;