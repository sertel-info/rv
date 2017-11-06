import React from 'react';
import Modal from '../../../../general/Modal.jsx';
import MultiForm from '../../../../general/MultiForm.jsx';
import NotificacoesBasicoFormFields from '../formfields/NotificacoesBasicoFormFields.jsx';
import NotificacoesEmailFormFields from '../formfields/NotificacoesEmailFormFields.jsx';
import Axios from 'axios';

class NotificacoesBtn extends React.Component {
	
	constructor(props){
		super(props);
		
		this.state = {
			mensagem : "",
			titulo : "",
			nivel : "danger",
			email_assunto : "",
			email_corpo : "",
			ativar_email : 0,
			a : props.assinante,
			show_success_modal : false,
			show_error_modal: false,
			errors : []
		}

		this.handleClick = this.handleClick.bind(this);
		this.handleConfirm = this.handleConfirm.bind(this);
		this.onFormChange = this.onFormChange.bind(this);
		this.valuesGetter = this.valuesGetter.bind(this);
		this.hideModal = this.hideModal.bind(this);
	}

	handleClick (event){
		event.preventDefault();
		this.setState({show : !this.state.show});
	}

	handleConfirm(event){

		Axios({
			
			method: "POST",
			url: _ROUTES_.notificacoes.store,
			data: this.state

		}).then(function(response){
			
			this.setState({show:false})

		}.bind(this)).catch(function(error){
			
			let resp = error.response;
			
			if(resp.status == 400){
				this.setState({errors : resp.data.validation_errors});
			}
			

		}.bind(this));


	}

	onFormChange(event){
		event.preventDefault();
		let state = {};
		state[event.target.name] = event.target.value;
		this.setState(state);
	}

	valuesGetter(attribute){
		return this.state[attribute];
	}

	hideModal(){
		this.setState({show:false});
	}

	getSuccessModal(){
		
	}

	getErrorsElements(){
		return this.state.errors.map(function(err, i){
				return <div key={i} className='alert bg-danger text-white'>{err}</div>;
		});
	}

	getFormModal(){
		let modal_content = <div> 
									{this.getErrorsElements()}
									<MultiForm stages={[{title:"Básico", content:<NotificacoesBasicoFormFields valuesGetter={this.valuesGetter} onChange={this.onFormChange}/>},
												{title:"Email", content:<NotificacoesEmailFormFields valuesGetter={this.valuesGetter} onChange={this.onFormChange}/>}]} />
							</div>;

		return<Modal show = {this.state.show}
						title = "Notificação"
						content = {modal_content}
						cancelLabel = "Cancelar"
						confirmLabel = "Confirmar"
						onConfirm = {this.handleConfirm}
						cancelable = {true}
						onHide={this.hideModal}
						onCancel={this.hideModal}
						confirmable = {true}/>
												

	}

	render(){
		let modal = this.getFormModal();

		return (<div>
					<a href="#" 
					   onClick={this.handleClick} 
					   className="btn btn-xs btn-primary"> 
					   <em className="fa fa-envelope-o fa-2x" aria-hidden="true"/> Notificações 
					</a>
					{modal}
				</div>)
	}
}

module.exports = NotificacoesBtn;