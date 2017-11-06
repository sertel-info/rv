import React from 'react';
import ExtratoLigacoesTable from './ExtratoLigacoesTable.jsx';
import ExtratoLigacoesFilters from './ExtratoLigacoesFilters.jsx';
import ExtratoLigacoesFiltersForm from './ExtratoLigacoesFiltersForm.jsx';
import DownloadBtn from '../../../general/DownloadBtn.jsx';

class ExtratoLigacoes extends React.Component {
	
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

		let modal_btns = [
			<a href="#" className="btn btn-warning" onClick={this.clearFilters}><i className="fa fa-close"></i> Limpar Filtros </a>,
			<a href="#" className="btn btn-primary" onClick={this.handleFilterSubmit}><i className="fa fa-search"></i> Filtrar </a>
		]

		return (<div>
					<div className="panel panel-default articles">
						<div className="panel-heading">
							Ligações
							<ExtratoLigacoesFilters onInputChange={this.handleFilterInputChange}
													valuesGetter={this.getFilterValue}
													customBtns={modal_btns}/>

							<DownloadBtn file_name={"Extrato_ligacao".concat(Date.now())} title="Exportar" mime_type="application/csv" sendData={this.state.filters} src={_ROUTES_.extrato.ligacoes_export} className="btn btn-primary mr-2 pull-right"/>
						</div>
						<div className="panel-body">
							<ExtratoLigacoesTable send_remote_data={{filters:this.state.filters}} 
												  should_update={this.state.should_update_table}/>
						</div>
					</div>
				</div>);
	}
}

module.exports = ExtratoLigacoes;