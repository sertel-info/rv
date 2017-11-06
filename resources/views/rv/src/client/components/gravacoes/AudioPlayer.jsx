import React from 'react';
import Axios from 'axios';

class AudioPlayer extends React.Component {
	
	constructor(props){
		super(props);

		/*this.state = {
			loading : true,
			blob : ""
		}*/
	}

	/*getBlobURL(data){
		let blob = new Blob([data], {type: "audio/x-wav"});
		return window.URL.createObjectURL(blob);
	}*/

	/*getBlobURL(data){
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
	}*/

	/*componentDidMount(){
		Axios({
			
			method: "GET",
			url: this.props.src

		}).then(function(response){
			console.log(response);

			this.setState({loading:false,
						   data:response.data});

		}.bind(this)).catch(function(error){
			
			console.log(error);

		}.bind(this));
	}*/

	render(){
		return (<audio controls type="audio/x-wav" src={this.props.src} className={this.props.className}>
					Seu Navegador não suporta este tipo de reprodução de áudio
				</audio>);
	}
}

module.exports = AudioPlayer;