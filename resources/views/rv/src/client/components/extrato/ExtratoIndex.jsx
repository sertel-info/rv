import React from 'react';
import MultiForm from '../../../general/MultiForm.jsx';
import ExtratoTransacoes from './ExtratoTransacoes.jsx';
import ExtratoLigacoes from './ExtratoLigacoes.jsx';

class ExtratoIndex extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let stages = [
						{"title": "Transações", content: <ExtratoTransacoes />},
						{"title": "Ligações", content: <ExtratoLigacoes />}
					 ];
		
		return (
				<div>
					<div className="row">
					<div className="col-lg-12">
						<h2 className="page-header">Extrato</h2>
					</div>
				</div>
				<MultiForm stages={stages} />
				</div>
				);
	}
}

module.exports = ExtratoIndex;