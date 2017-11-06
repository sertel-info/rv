import React from 'react';
import Table from '../../../general/table/Table.jsx';

class ExtratoLigacoesTable extends React.Component {
	
	constructor(props){
		super(props);

	}

	formatPhone(data){
		if(data.match(/^0[0-9]00/) !== null)
		    return data;
		
		if(data.length >= 10 && data.length <= 14){
		          			
		    let num_arr = data.match(/^(00|0|9090|90|55)?(([0-9]{2})?([0-9]{2}))?(([0-9])[0-9]{7,})(\s.*)?/);
		    let ddd = num_arr[4] !== undefined ? "("+num_arr[4].toString()+")" : "";
		     
		    let num = "";			
		    if(num_arr[5]){
		         num = num_arr[5].replace(/^([0-9]{4,5})([0-9]{4})$/, "$1-$2");
		    } else {
		         num = data;
		    }
		          			
		    return ddd.concat(' ',num);
		}
		
		return data;
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
							},
							{
							 title : "Valor",
							 acessor : "cost",
							 render : (cost, row) => {
							 	return "R$ ".concat(cost);
							 }
							}
						    ]

		return (<div>
					<Table 
							id="ext-ligacoes-table"
							class="table table-bordered"
							remote={_ROUTES_.extrato.ligacoes_data}
							should_update={this.props.should_update}
							send_remote_data={this.props.remote_data}
							columns={columns_defs}></Table>
				</div>);
	}
}

module.exports = ExtratoLigacoesTable;