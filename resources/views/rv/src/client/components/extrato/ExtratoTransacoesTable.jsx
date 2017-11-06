import React from 'react';
import Table from '../../../general/table/Table.jsx';

class ExtratoTransacoesTable extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let columns_defs = [
							{
							 title : "Data",
							 acessor: "date"
							},
							{
							 title : "Hora",
							 acessor: "time"
							},
							{
							 title : "Valor",
							 acessor : "value",
							 render: (value, row) => {
							 	if(parseFloat(value) >= 0)
							 		return <p className="text-success"> {"R$ +".concat(value)} </p>
							 	else 
							 		return <p className="text-danger"> {"R$ ".concat(value)} </p>
							 }
							}
						    ]

		return (<div>
					<Table 
							id="transacoes-table"
							class="table table-bordered"
							remote={_ROUTES_.extrato.transacoes_data}
							columns={columns_defs}></Table>
				</div>);
	}
}

module.exports = ExtratoTransacoesTable;