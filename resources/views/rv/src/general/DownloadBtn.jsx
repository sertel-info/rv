import React from 'react';
import Axios from 'axios';

class DownloadBtn extends React.Component {
	
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
		let blob = new Blob([data], {type: this.props.mime_type}),
		    url = window.URL.createObjectURL(blob);
		a.href = url;
		let extension = this.props.extension == undefined ? this.props.mime_type.split('/')[1] : this.props.extension; 
		a.download = this.props.file_name.concat('.', extension);
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
			url: this.props.src,
			params: this.state.send_data,
			responseType: 'blob'

		}).then(function(response){
			
			console.log('response', response);
			this.saveData(response.data);

		}.bind(this)).catch(function(error){
			
			console.log(error);

		}.bind(this));
	}

	render(){
		return (
				<a href="#" onClick={this.handleClick} className={this.props.className}><i className="fa fa-download"/> {this.props.title} </a>
				);
	}
}

module.exports = DownloadBtn;