import React from 'react';
import CurrencyInput from 'react-currency-input';
import Axios from 'axios';
import Modal from '../../../general/Modal.jsx';
import ReactDOM from 'react-dom';

class CreditosIndex extends React.Component {
	
	constructor(props){
		super(props);

		this.state = {
			c_rmv : "0.00",
			c_add : "0.00",
			show_success_modal : false,
			show_error_modal : false
		}

		this.succeeded = false;
		this.errors = [];

		try{
			this.state['u'] = this.props.location.params.assinante
		} catch(e){
			window.location = "#/assinantes";
		}

		this.handleInputChange = this.handleInputChange.bind(this);
		this.submitAddCredits = this.submitAddCredits.bind(this);
		this.submitRmvCredits = this.submitRmvCredits.bind(this);
		this.getErrorsModal = this.getErrorsModal.bind(this);
		this.getSuccessModal = this.getSuccessModal.bind(this);
		this.handleModalHide = this.handleModalHide.bind(this);
	}

	handleInputChange(event){
		event.preventDefault();
		let state = {};
		state[event.target.name] = event.target.value;
		this.setState(state);
	}

	submitAddCredits(event){
		event.preventDefault();
		Axios({
			
			method: "POST",
			url: _ROUTES_.assinantes.add_credits,
			data : {
				c_add : this.state.c_add.replace(/\./g, '').replace(/,/g, '.').replace(/[^0-9\.]+/g, ''),
				u : this.state.u
			}

		}).then(function(response){
			
			this.setState({show_success_modal: true,
						   show_error_modal: false});
			
		}.bind(this)).catch(function(error){
			this.succeeded = false;

			let response = error.response;
			if(response.status == 400){
				this.errors = response.data.validation_errors;
			} else {
				this.errors = ['Um erro inesperado ocorreu, por favor, tente novamente.'];
			}

			this.setState({show_success_modal: false,
						   show_error_modal: true});
		}.bind(this));
	}


	submitRmvCredits(event){
		event.preventDefault();
		this.succeeded = false;
		this.errros = [];

		Axios({
			
			method: "POST",
			url: _ROUTES_.assinantes.rmv_credits,
			data : {
				c_rmv : this.state.c_rmv.replace(/\./g, '').replace(/,/g, '.').replace(/[^0-9\.]+/g, ''),
				u : this.state.u
			}

		}).then(function(response){
			
			this.setState({show_success_modal: true,
						   show_error_modal: false});
			
		}.bind(this)).catch(function(error){
			this.succeeded = false;

			let response = error.response;
			if(response.status == 400){
				this.errors = response.data.validation_errors;
			} else {
				this.errors = ['Um erro inesperado ocorreu, por favor, tente novamente.'];
			}

			this.setState({show_success_modal: false,
						   show_error_modal: true});
		}.bind(this));
	}

	handleModalHide(){
		this.setState({show_success_modal: false,
						   show_error_modal: false});
	}

	getErrorsModal(){
		let content = this.errors.map(function(err, i){
				return <div key={i} className='alert bg-danger text-white'>{err}</div>;
		});


		return <Modal show={this.state.show_error_modal} 
						   content={content} 
						   title="Atenção"
						   cancelable={true}
						   cancelLabel="Voltar"
						   onHide={this.handleModalHide}
						   />
	}

	getSuccessModal(){
		let content =  <div className="alert">
							<h2 className="text-success"><i className="fa fa-check"/>&nbsp;Créditos atualizados com successo !</h2>
						</div>;

		return <Modal show={this.state.show_success_modal} 
						content={content} 
						title="Sucesso!"
						cancelable={false}
						confirmable={true}
						onConfirm = {() => {window.location = "#/assinantes"}}
						confirmLabel="Continuar"
						/>
	}

	render(){
		let success_modal = this.state.show_success_modal ? this.getSuccessModal() : null;
		let errors_modal = this.state.show_error_modal ? this.getErrorsModal() : null;

		return (
				<div className="col-lg-12 container">
					<div className="col-md-6 alert-success" style={{padding:"20px"}}> 
						<h2 className="text-success"> <span className="glyphicon glyphicon-plus gi-1x"></span> Adicionar </h2>
						<div className="form-group form-group-lg">
							<CurrencyInput onChangeEvent={this.handleInputChange} precision="2" suffix=" R$" decimalSeparator="," thousandSeparator="." size="20" value={this.state.c_add} name="c_add" className="form-control"/>
						</div>
						<div className="row">
							<button onClick={this.submitAddCredits} className="btn btn-block btn-success"> Adicionar </button>
						</div>							
					</div>
					<div className="col-md-6 alert-danger"  style={{padding:"20px"}}>
						<h2 className="text-danger"> <span className="glyphicon glyphicon-plus gi-1x"></span> Remover </h2>
						<div className="form-group form-group-lg">
							<CurrencyInput onChangeEvent={this.handleInputChange} precision="2" suffix=" R$" decimalSeparator="," thousandSeparator="." size="20" value={this.state.c_rmv} name="c_rmv" className="form-control"/>
						</div>
						<div className="row">
							<button onClick={this.submitRmvCredits}className="btn btn-block btn-danger"> Remover </button>
						</div>							
					</div>
					{success_modal}
					{errors_modal}
				</div>
			);
	}
}

module.exports = CreditosIndex;