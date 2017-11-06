import React from 'react';
import Axios from 'axios';
import PickList from '../../../general/PickList.jsx';

class ClientLinhasPickList extends React.Component {
	
	constructor(props){
		super(props);
		this.state ={
			is_loading : true,
			options : []
		}

	}

	componentDidMount(){
		Axios({
			
			method: "GET",
			url: _ROUTES_.linhas.get_list

		}).then(function(response){
			/*let options =  response.data.linhas.map(function(nome, id){
				return {title: nome, value: id}
			});*/
			let options = [],
				linhas = response.data.linhas;

			for(let id in linhas){
				options.push({title: linhas[id], value:id.toString()});
			}

			this.setState({is_loading: false,
						   options: options});
			

		}.bind(this)).catch(function(error){
			
			console.log(error);

		}.bind(this));
	}

	render(){
		if(this.state.is_loading)
			return <img className="loading" src="img/sertel-loading.gif"/> 

		return (<PickList onChange={this.props.onChange} value={this.props.value} name={this.props.name} options={this.state.options}/>);
	}
}

module.exports = ClientLinhasPickList;