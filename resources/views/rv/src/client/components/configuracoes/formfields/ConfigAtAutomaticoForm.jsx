import React from 'react';
import Axios from 'axios';

class ConfigAtAutomatico extends React.Component {
	
	constructor(props){
		super(props);
		this.state = {
			loading : true,
			options : {}
		}

		this.opts_grupos = [];
		this.opts_filas = [];
		this.opts_uras = [];
	}
	
	componentDidMount(){
			Axios({
				
				method: "GET",
				url: _ROUTES_.configuracoes.get_at_auto_opts
			
			}).then(function(response){
				let data = response.data;
				console.log(data);
				this.opts_grupos =  data.grupos.length == 0 ? [] : 
								<optgroup key="g" label="-- Grupos --">
								{
								  	data.grupos.map((gr, idx) => {
								  		return <option key={"g".concat(idx)} value={"g_".concat(gr.id)}>{gr.nome}</option>
								  	})
								}
							   </optgroup>

				this.opts_filas = data.filas.length == 0 ? [] : 
								  <optgroup key="f" label="-- Filas --">
									{
									  	data.filas.map((fi, idx) => {
									  		return <option key={"f".concat(idx)} value={"f_".concat(fi.id)}>{fi.nome}</option>
									  	})
									}
								  </optgroup>;

				this.opts_uras = data.uras.length == 0 ? [] : 
								  <optgroup key="u" label="-- Uras --">
									{
									  	data.uras.map((ura, idx) => {
									  		return <option key={"u".concat(idx)} value={"u_".concat(ura.id)}>{ura.nome}</option>
									  	})
									}
								  </optgroup>;


				this.setState({options:response.data,
							   loading : false});

			}.bind(this)).catch(function(error){
				
				console.log(error);
				
			}.bind(this));
	}


	render(){

		let onInputChange = this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;
		
		let options = [this.opts_grupos, this.opts_filas, this.opts_uras];
		
		if((this.opts_grupos.length + this.opts_filas.length + this.opts_uras.length) == 0)
			options = <option value=""> Nenhuma opção disponível </option>;
					 
		return (<div className="row col-lg-12">
					<h4><p> Atendimento automático </p></h4>
					<div className="form-group col-lg-3">
							<label>Status</label>
							<select name="at_automatico" onChange={onInputChange} value={valuesGetter("at_automatico")} className="form-control" placeholder="">
								<option value="1"> Ativado </option>
								<option value="0"> Desativado </option>
							</select>
					</div>
					<div className="form-group col-lg-4">
						<label>Atendedor</label>
						{
							this.state.loading ? 
								<div className="col-lg-12"> <img className="loading-sm" src="/img/sertel-loading.gif"></img> </div>
								:
								<select name="at_automatico_dest" onChange={onInputChange} value={valuesGetter("at_automatico_dest")} className="form-control" placeholder="">
									<option value="0" disabled> -- Atendedor -- </option>
									{this.opts_grupos}
									{this.opts_filas}
									{this.opts_uras}
								</select>
						}
					</div>
				</div>);
	}
}

module.exports = ConfigAtAutomatico;