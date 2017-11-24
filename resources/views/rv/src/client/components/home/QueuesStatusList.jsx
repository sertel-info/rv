import React from 'react';
import Table from '../../../general/table/Table.jsx';
class QueuesStatusList extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let columns_defs = [
							{
							 title : "Fila",
							 acessor: "nome_orig"
							},
							{
							 title: "TMA",
							 acessor: "talktime"
							},
							{
							 title: "TME",
							 acessor: "holdtime"
							}
							];
		return (<div className="panel panel-default">
					<div className="panel-heading">
						Filas
					</div>
					<div className="panel-body">
						<Table 
								id="queues-table"
								class="table "
								remote={_ROUTES_.client.get_filas_stats}
								columns={columns_defs}
								send_remote_data={this.props.send_remote_data}
								td_class="text-center"
								th_class="text-center"
							/>
					</div>
				</div>);
	}
}

module.exports = QueuesStatusList;