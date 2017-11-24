import React from 'react';
import Table from '../../../general/table/Table.jsx';
import DestroyBtn from '../../../general/DestroyBtn.jsx';
import {Link, HashRouter as Router} from 'react-router-dom';

class UrasTable extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
			let columns_defs = [
							{
							 title : "Nome",
							 acessor: "nome"
							},
							{
							 title : "Ações",
							 acessor : "id",
							 render : (data,row) => {
							 	let btnActions = <div>
							 						<Link to={{pathname:"/uras/editar", params:{ura:data}}} className="btn btn-xs btn-primary"> <em className="fa fa-edit fa-2x" aria-hidden="true"/> Editar </Link>
							 						&nbsp;
							 						<DestroyBtn onDelete={this.forceUpdate.bind(this)} href={_ROUTES_.uras.destroy} data_id={data}/>
							 					 </div>;
							 	return btnActions;
							 }
							}
						    ]

		return (<div>
					<Table 
							id="uras-table"
							class="table table-bordered"
							remote={_ROUTES_.uras.data}
							columns={columns_defs}/>
				</div>);
	}
}

module.exports = UrasTable;