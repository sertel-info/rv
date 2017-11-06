import React from 'react';
import Axios from 'axios';

class ExportBtn extends React.Component {
	
	constructor(props){
		super(props);

		this.state = {
			send_data : this.props.sendData !== undefined ? this.props.sendData : {}
		}

		this.handleClick = this.handleClick.bind(this);
	}

	saveData(data){
		let a = document.createElement("a");
		document.body.appendChild(a);
		a.style = "display: none";
		let blob = new Blob([data], {type: "application/csv"}),
		    url = window.URL.createObjectURL(blob);
		a.href = url;
		a.download = "Extrato".concat(Date.now());
		a.click();
		window.URL.revokeObjectURL(url);
	}
	
	componentWillReceiveProps(nextProps){
		this.setState({
			send_data : nextProps.sendData
		});
	}

	handleClick(event){
		event.preventDefault();
		
		Axios({
			
			method: "GET",
			url: this.props.src

		}).then(function(response){
			
			this.saveData(response.data);

		}.bind(this)).catch(function(error){
			
			console.log(error);

		}.bind(this));
	}

	render(){
		return (
				<a href="#" onClick={this.handleClick} className={this.props.className}><i className="fa fa-download"/> Exportar </a>
				);
	}
}

module.exports = ExportBtn;