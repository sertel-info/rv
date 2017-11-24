import React from 'react';
import GravacoesTable from './GravacoesTable.jsx';
import GravacoesFilters from './GravacoesFilters.jsx';

class GravacoesIndex extends React.Component {
	
	constructor(props){
		super(props);

		this.state = {
			should_update_table : true,
			filters : {
						tipo_chamada : "todos",
						tipo_destino : "todos",
						origem : "",
						destino : "",
						data_max : "",
						hora_max : "",
						duracao_min : "",
						duracao_max : ""
					  } 
		}

		this.handleFilterInputChange = this.handleFilterInputChange.bind(this);
		this.handleFilterSubmit = this.handleFilterSubmit.bind(this);
		this.getFilterValue = this.getFilterValue.bind(this);
		this.clearFilters = this.clearFilters.bind(this);
	}

	handleFilterInputChange(event){
		event.preventDefault();

		let filters = this.state.filters;
		filters[event.target.name] = event.target.value;
		this.setState({filters : filters,
					   should_update_table: false});
	}

	handleFilterSubmit(event){
		event.preventDefault();
		this.setState({should_update_table: true});
	}


	getFilterValue(attribute){
		return this.state.filters[attribute];
	}

	clearFilters(event){
		event.preventDefault();
		let filters = Object.assign(this.state.filters, {
												tipo_chamada : "todos",
												tipo_destino : "todos",
												origem : "",
												destino : "",
												data_max : "",
												hora_max : "",
												duracao_min : "",
												duracao_max : ""
											});
		this.setState({filters:filters});
	}

	render(){
		let filter_modal_btns = [
			<a href="#" className="btn btn-warning" onClick={this.clearFilters}><i className="fa fa-close"></i> Limpar Filtros </a>,
			<a href="#" className="btn btn-primary" onClick={this.handleFilterSubmit}><i className="fa fa-search"></i> Filtrar </a>
		]

		return (<div>
					<div className="row">
						<div className="col-lg-12">
							<h2 className="page-header">Gravações</h2>
						</div>
					</div>
					<div className="panel panel-default">
							<div className="panel-heading">
								Gravações
								<GravacoesFilters onInputChange={this.handleFilterInputChange}
											valuesGetter={this.getFilterValue}
											customBtns={filter_modal_btns}/>
							</div>
							<div className="panel-body">
								<GravacoesTable send_remote_data={{filters: this.state.filters}}
												should_update={this.state.should_update_table} />
							</div>
					</div>
				</div>
				);
	}
}

module.exports = GravacoesIndex;