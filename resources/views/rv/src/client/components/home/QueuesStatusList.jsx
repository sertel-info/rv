import React from 'react';

class QueuesStatusList extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		return (<div className="panel panel-default">
					<div className="panel-heading">
						Ramais
					</div>
					<div className="panel-body">
						<Table 
								id="queues-table"
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

module.exports = QueuesStatusList;