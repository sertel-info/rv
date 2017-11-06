import React from 'react';

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
					<li className="dropdown">
						<a className="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<em className="fa fa-envelope"></em><span className="label label-danger">15</span>
					</a>
						<ul className="dropdown-menu dropdown-messages">
							<li>
								<div className="dropdown-messages-box"><a href="profile.html" className="pull-left">
									</a>
									<div className="message-body"><small className="pull-right">3 mins ago</small>
										<a href="#"><strong>John Doe</strong> commented on <strong>your photo</strong>.</a>
									<br /><small className="text-muted">1:24 pm - 25/03/2015</small></div>
								</div>
							</li>
							<li className="divider"></li>
							<li>
								<div className="dropdown-messages-box"><a href="profile.html" className="pull-left">
									</a>
									<div className="message-body"><small className="pull-right">1 hour ago</small>
										<a href="#">New message from <strong>Jane Doe</strong>.</a>
									<br /><small className="text-muted">12:27 pm - 25/03/2015</small></div>
								</div>
							</li>
							<li className="divider"></li>
							<li>
								<div className="all-button"><a href="#">
									<em className="fa fa-inbox"></em> <strong>All Messages</strong>
								</a></div>
							</li>
						</ul>
					</li>
				
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