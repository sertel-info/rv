import React from 'react';
import Axios from 'axios';

class RemoteDataSelect extends React.Component {
	
	constructor(props){
		super(props);
		
		this.state = {
			options : [],
			value : props.value
		}

		this._is_mounted = false;
	}

	componentDidMount(){
		this._is_mounted = true;
		let $node = $(this.node);
		$node.hide();
		$node.parent().append($('<div class="row loading-container"><img class="loading-sm ml-5" src="/img/sertel-loading.gif"/></div>'));

		Axios({
			
			method: "GET",
			url: this.props.src
	
		}).then(function(response){

			this.setState({options : response.data.data});
			$node.show();
			$node.parent().find('.loading-container').remove();

		}.bind(this)).catch(function(error){
					
			console.log(error);

		}.bind(this));
	}

	componentWillReceiveProps(nextProps){
		if(this._is_mounted)
			this.setState({value: nextProps.value});
	}

	render(){
		return (
				<select ref={(select) => this.node = select} 
						value={this.state.value} 
						onChange={this.props.onChange} 
						className={this.props.className} 
						name={this.props.name}>
					{
						this.props.children
					}
					{
						this.state.options.map(function(item, i){
							return <option key={i} value={item.id}> {item.nome} </option>
						})
					}

				</select>
			   );
	}
}

module.exports = RemoteDataSelect;