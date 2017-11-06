import React from 'react';
import ExtratoTransacoesTable from './ExtratoTransacoesTable.jsx';

class ExtratoTransacoes extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		return (<div>
					<div className="panel panel-default articles">
						<div className="panel-heading">
							Transações
						</div>
						<div className="panel-body">
							<ExtratoTransacoesTable />
						</div>
					</div>
				</div>
				);
	}
}

module.exports = ExtratoTransacoes;