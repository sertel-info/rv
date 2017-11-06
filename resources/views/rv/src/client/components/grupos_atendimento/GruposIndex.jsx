import React from 'react';
import GruposTable from './GruposTable.jsx';
import {Link, HashRouter} from 'react-router-dom';

class GruposIndex extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		return (<div className="panel panel-default">
					<div className="panel-heading">
						Grupos
						<Link to="/grupos/criar" className="btn btn-success pull-right"><em className="fa fa-plus"></em> Criar grupo </Link>
					</div>
					<div className="panel-body">
						<GruposTable/>
					</div>
				</div>);
	}
}

module.exports = GruposIndex;