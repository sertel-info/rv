import React from 'react';
import Axios from 'axios';
import Modal from './Modal.jsx';

class FormInterface extends React.Component {
	
	constructor(props){
		super(props);

		this.errors = [];
		this.route = "";
		this.handleInputChange = this.handleInputChange.bind(this);
		this.handleFormSubmit = this.handleFormSubmit.bind(this);
		this.getValueOf = this.getValueOf.bind(this);
		this.should_show_modal = false;
		this.has_succeeded = false;
		this.params = {};

	}

	shouldShowModal(){
		return this.should_show_modal;
	}

	getModalToShow(){
		if(this.hasErrors() && this.shouldShowModal())
			return this.getErrorsModal();
		else if(this.hasSucceeded() && this.shouldShowModal())
			return this.getSuccessModal();

		return null;
	}

	handleInputChange(event){
		event.preventDefault();
		//reinicia os erros
		this.errors = [];
		this.should_show_modal = false;
	
		let state = {};

		if(event.detail !== undefined && event.detail.is_pick_list){
			state[event.detail.target.name] = event.detail.pl_value;
		} else {
			state[event.target.name] = event.target.value;
		}

		this.setState(state);
	}

	handleFormSubmit(event){
		event.preventDefault();
		this.should_show_modal = true;
		this.errors = [];
		let params = this.params && typeof this.params === 'function' ? this.params() : this.params;

		Axios({

			method: "POST",
			url: this.route,
			data : Object.assign(this.state, params)

		}).then(function(response){
			
			this.has_succeeded = true;
			this.forceUpdate();
			
		}.bind(this)).catch(function(error){
			
			let response = error.response;

			if(response.status == 401)
				window.location = "/login";

			if(response.status == 400){
				//this.setState({errors:  response.data.validation_errors});
				this.errors = response.data.validation_errors;
				this.forceUpdate();
			}

			if(response.status == 500){
				//this.setState({errors:  response.data.validation_errors});
				this.errors = ["Um erro inesperado ocorreu, por favor tente novamente"];
				this.forceUpdate();
			}
		
		}.bind(this));
	}

	getValueOf(attribute){
		return this.state[attribute];
	}

	getErrorsModal(){
		let content = this.errors.map(function(err, i){
				return <div key={i} className='alert bg-danger text-white'>{err}</div>;
		});

		return <Modal ref={(node) => this.rmv_modal_node = node } show={true} 
						   content={content} 
						   title="Atenção"
						   cancelable={true}
						   cancelLabel="Voltar"
						   />
	}

	hasSucceeded(){
		return this.has_succeeded;
	}

	getSuccessModal(){
		let content = this.success_message;
		return <Modal 
						show={true} 
						   content={content} 
						   title="Sucesso!"
						   cancelable={false}
						   confirmable={true}
						   onConfirm = {this.onSuccess}
						   confirmLabel="Continuar"
						   />
	}

	hasErrors(){
		return this.errors !== undefined && this.errors.length > 0;
	}
}

module.exports = FormInterface;