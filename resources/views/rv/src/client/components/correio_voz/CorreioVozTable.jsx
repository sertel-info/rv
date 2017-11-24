import React from 'react';
import Table from '../../../general/table/Table.jsx';

class CorreioVozTable extends React.Component {
	
	constructor(props){
		super(props);
	}

	render(){
		let columns_defs = [
							{
							 title : "Origem",
							 acessor: "origem",
							 render : this.formatPhone
							},
							{
							 title : "Destino",
							 acessor: "destino",
							 render : this.formatPhone
							},
							{
							 title : "Data",
							 acessor: "date"
							},
							{
							 title : "Hora",
							 acessor: "time"
							},
							{
							 title : "Duração",
							 acessor: "billsec_time"
							}
						    ]

		return (<div>
					<Table 
							id="correio-voz-table"
							class="table table-bordered"
							remote={_ROUTES_.correio_voz.data}
							columns={columns_defs}></Table>
				</div>);
	}
}

module.exports = CorreioVozTable;