import React from 'react';
import PickList from '../../../../general/PickList.jsx';

class LinhasCodecsFormFields extends React.Component {
	
	constructor(props){
		super(props);

		this.all_codecs = [{title: 'ulaw', value: 'ulaw'},
						    {title : 'alaw', value: 'alaw'},
							{title : 'g722', value: 'g722'},
							{title : 'g723', value: 'g723'},
							{title : 'g726', value: 'g726'},
							{title : 'g729', value: 'g729'},
							{title : 'gsm', value: 'gsm'},
							{title : 'speex', value: 'speex'},
							{title : 'slin', value: 'slin'},
							{title : 'h261', value: 'h261'},
							{title : 'h263', value: 'h263'},
							{title : 'h263p', value: 'h263p'},
							{title : 'h264', value: 'h264'},
							{title : 'ilbc', value: 'ilbc'}];

		this.state = {
			
		}

	}



	render(){
		return (<PickList onChange={this.props.onInputChange} value={this.props.valuesGetter("codecs")} name="codecs" options={this.all_codecs}/>);
	}
}

module.exports = LinhasCodecsFormFields;