import React from 'react';
import Table from '../../../general/table/Table.jsx';
class PeerStatusList extends React.Component {
	
	constructor(props){
		super(props);
	}

	render(){
		let columns_defs = [
							{
							 title : "Ramal",
							 acessor: "login_ata"
							},
							{
							 title : "Status",
							 acessor: "status",
							 render : (data, row) => {
							 	/*
								* possiveis status :
								* OK
								* UNKNOWN
								* Unmonitored
								* UNREACHABLE
								* IN USE
								* Error
							 	*/
							 	switch(data){
							 		case "OK" : 
							 			return <span className="label label-warning">Registrado</span>;
							 		break;
							 		case "IN USE" : 
							 			return <span className="label label-success">Em uso</span>;
							 		break;
							 		default : 
							 			return <span className="label label-default">Não registrado</span>;
							 		break;
							 	}
							 }
							}
							];
							
		return (<div className="panel panel-default">
							<div className="panel-heading">
								Ramais
							</div>
							<div className="panel-body">
								<Table 
										id="peers-table"
										class="table "
										remote={_ROUTES_.client.get_linhas_stats}
										columns={columns_defs}
										send_remote_data={this.props.send_remote_data}
										td_class="text-center"
										th_class="text-center"
										refresh_time={2000}
									/>
							</div>
					</div>);
	}
}

module.exports = PeerStatusList;