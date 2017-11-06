import React from 'react';
import Axios from 'axios';
import ReactPaginate from 'react-paginate';

class Table extends React.Component {
	
	constructor(props){
		super(props);
		
		this.props = props;

		this.state = {
			columns : props.columns,
			data : props.data,
			page_size : props.page_size !== undefined || props.page_size == 0 ? props.page_size : 10,
			remote : props.remote,
			style : props.class,
			total_records : 0,
			curr_page : 0,
			page_count: 0
		}

		/*dados que serão enviados para caso seja utilizados dados remotos*/
		this.remote_data = {};
		/*
		* Este atributo determina se o loading será mostrado ou não
		* Usado para tabelas que fiquem dando refresh não mostrarem o loading 
		* A cada requisição
		*/
		this.should_show_loading = true;

		this.getRemoteData = this.getRemoteData.bind(this);
		this.handlePageChange = this.handlePageChange.bind(this);
		this.refreshData = this.refreshData.bind(this);

	}

	componentDidMount(){
		if(this.props.refresh_time !== undefined){
			this.should_show_loading = false;
			window.setInterval(this.getRemoteData, this.props.refresh_time);
		}
	}

	componentWillReceiveProps(nextProps){
		if(nextProps.should_update === false)
			return;

		if(nextProps.send_remote_data !== undefined){
			this.remote_data = nextProps.send_remote_data;
		}

		this.getRemoteData();
	}

	getRemoteData(){
		alert(this.state.remote);
		let $tbody = $("#"+this.props.id+" tbody");

		if(this.should_show_loading){
			$tbody.find('tr').hide();
			$tbody.append('<tr class="loading-row"><td colspan='+this.state.columns.length+'> <center> <img src="/img/sertel-loading.gif" class="loading"/> </center></td><tr>');
		}

		let params = {
					  curr_page : this.state.curr_page+1,
					  itens_per_page : this.state.page_size
					 };

		params = Object.assign(params, this.remote_data);

		Axios({
			
			method: "GET",
			url: this.state.remote,
			params: params

		}).then(function(response){
			console.log(response);
			let data = response.data;
			let callback = !this.should_show_loading ?  ()=>{} : () => {		
																		$tbody.find(".loading-row").remove();
																		$tbody.find("tr").show();
																	   };
			this.setState({
				total_records : data.total_records,
				data : data.data,
				page_count: Math.ceil(data.total_records/parseInt(this.state.page_size))
			}, callback);

		}.bind(this)).catch(function(error){
			
			console.log(error);

		}.bind(this));
	}

	handlePageChange(data){
		this.setState({curr_page:data.selected}, this.getRemoteData);
	}

	render(){
		let state = this.state,
			columns = state.columns,
			rows = state.data == undefined || state.data.length == 0 ? 
			  <tr><td className="text-center" colSpan={columns.length}> Nenhum registro </td></tr> :
			   state.data.map(function(row, i){
			   						let td_class = this.props.td_class;
									return <tr key={i}>
												{
													columns.map(function(column, i){
														
														let acessor = column.acessor,
														    data = row[acessor];

														if(acessor.indexOf('.') != -1){
															let terms = acessor.split('.');
															data = row[terms[0]];
															acessor.split('.').map(function(term, i){
																if(i !== 0 && data !== null)
																	data = data[term];
															}.bind(data));
														}

														let cell_data = column.render == undefined ?
																	data :
																	column.render(data, row);
														return <td className={td_class} key={i}>{cell_data}</td>;
													})
											    }	
											</tr>
				}.bind(this));

		let th_class = this.props.th_class;
		return (
				<div>
					<table id={this.props.id} className={state.style} style={{"marginBottom":0}}>
						<thead>	
							<tr>
							{	
								state.columns.map(function(column, i){
									return (<th className={th_class} key={i}>
												{column.title}
											</th>)
								})
							}
							</tr>
						</thead>
						<tbody>
								{
									rows
								}
						</tbody>
					</table>
				  <div className=''>
				  		<ReactPaginate pageCount={this.state.page_count}
				  					   pageRangeDisplayed={3}
				  					   marginPagesDisplayed={1}
				  					   previousLabel="<"
				  					   nextLabel=">"
				  					   breakLabel={<a href="" onClick={(event)=> event.preventDefault()}>...</a>}
				  					   initialPage={0}
				  					   containerClassName="pagination pull-right"
									   pageClassName=""
									   activeClassName="active"
									   breakClassName=""
									   onPageChange={this.handlePageChange}
				  					   />
				  </div>
				</div>
			   );
	}
}

module.exports = Table;
