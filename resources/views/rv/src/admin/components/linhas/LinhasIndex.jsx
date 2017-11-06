import React from 'react';
import LinhasTable from './LinhasTable.jsx';
import {HashRouter as Router, Link } from 'react-router-dom';

class LinhasIndex extends React.Component {
	
	constructor(props){
		super(props);
	}

	render(){
		return (<div className="panel panel-default">
					<div className="panel-heading">
						Linhas
						<Link to="/linhas/criar" className="btn btn-success pull-right"><em className="fa fa-plus"></em> Criar linha</Link>
					</div>
					<div className="panel-body">
						<LinhasTable/>
					</div>
				</div>
				);
	}
}

module.exports = LinhasIndex;