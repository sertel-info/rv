import React from 'react';
import UrasTable from './UrasTable.jsx';
import {Link, HashRouter as Router} from 'react-router-dom';


class UrasIndex extends React.Component {
	
	constructor(props){
		super(props);	
	}


	render(){
		return (<div>
					<div className="row">
						<div className="col-lg-12">
							<h2 className="page-header">Uras</h2>
						</div>
					</div>
					<div className="panel panel-default">
						<div className="panel-heading">
							Uras
							<Link to="/uras/criar" className="btn btn-success pull-right"><em className="fa fa-plus"></em> Criar ura</Link>
						</div>
						<div className="panel-body">
							<UrasTable />
						</div>
					</div>
				</div>);
	}
}

module.exports = UrasIndex;