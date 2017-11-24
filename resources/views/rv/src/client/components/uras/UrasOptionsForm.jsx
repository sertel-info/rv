import React from 'react';
import Axios from 'axios';

class UrasOptionsForm extends React.Component {
	
	constructor(props){
		super(props);

		this.state = {
			/*Opções possíveis para a ura*/
			options : [],
			is_loading : true
		}
	}

	componentDidMount(){
		Axios({
			
			method: "GET",
			url: _ROUTES_.uras.get_options
		
		}).then(function(response){
			
			this.setState({options:response.data,
						   is_loading : false});

		}.bind(this)).catch(function(error){
			
			console.log(error);
			
		}.bind(this));
	}


	render(){
		if(this.state.is_loading)
			return <div className="col-lg-12"> <img className="loading" src="/img/sertel-loading.gif"></img> </div>;

		let onChange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;

		let opts_ramais = this.state.options.ramais === undefined || this.state.options.ramais.length == 0 ? null :
						  <optgroup label="-- Ramais --">
							{ 
							  	this.state.options.ramais.map((ra, idx) => {
							  		return <option key={idx} value={"r_".concat(ra.id)}>{ra.nome}</option>
							  	})
							}
						  </optgroup>,

			opts_grupos = this.state.options.grupos === undefined || this.state.options.grupos.length == 0 ? null : 
						 <optgroup label="-- Grupos --">
							{
							  	this.state.options.grupos.map((gr, idx) => {
							  		return <option key={idx} value={"g_".concat(gr.id)}>{gr.nome}</option>
							  	})
							}
						  </optgroup>,

			opts_filas = this.state.options.filas === undefined || this.state.options.filas.length == 0 ? null : 
						 <optgroup label="-- Filas --">
							{
							  	this.state.options.filas.map((fi, idx) => {
							  		return <option key={idx} value={"f_".concat(fi.id)}>{fi.nome}</option>
							  	})
							}
						 </optgroup>;
		
		return (<div className="col-lg-12">
						<div className="col-lg-5">
						
							<table className="table">
								<tbody>
								{
								[1,2,3,4,5,6].map(function(digit, i){
									return <tr key={i}>
												<td> <span style={{fontSize:"2em"}} className="badge pull-right">{digit}</span> </td>
												<td>
													<select value={valuesGetter("digito_".concat(digit))} onChange={onChange} className="form-control full-width" name={"digito_".concat(digit)}>
														<option value="0"> Nenhum </option>
														{opts_ramais}
														{opts_grupos}
														{opts_filas}
												   	</select>
											   	</td>
											</tr>
								})
								}
								</tbody>
							</table>
						</div>
						<div className="col-lg-5">
							<table className="table">
								<tbody>
								{
								[7,8,9,0,"#","*"].map(function(digit, i){
									let dgt_value_get = "digito_".concat(digit);
									
									if(digit === "#")
										dgt_value_get = "digito_tralha";
									else if(digit === "*")
										dgt_value_get = "digito_ast";

									return <tr key={i}>
												<td> <span style={{fontSize:"2em"}} className="badge pull-right">{digit}</span> </td>
												<td>
													<select value={valuesGetter(dgt_value_get)} onChange={onChange} className="form-control full-width" name={dgt_value_get}>
														<option value="0"> Nenhum </option>
														{opts_ramais}
														{opts_grupos}
														{opts_filas}
												   	</select>
											   	</td>
											</tr>
								})
								}
								</tbody>
							</table>
						</div>
					</div>);
	}
}

module.exports = UrasOptionsForm;
