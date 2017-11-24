import React from 'react';
import LinhasForm from './LinhasForm.jsx';

import FormInterface from '../../../general/FormInterface.jsx';

class LinhasCreate extends FormInterface {
	
	constructor(props){
		super(props);

		this.state = {
			/** basico */
			nome : "",
			assinante : 0,
			ddd_local : "",
			simultaneas : "",
			rota_cli : 0,
			plano : 0,
			/** autenticação */
			login_ata : "",
			usuario : "",
			senha: "",
			ip: "",
			porta: "",
			/* DID */
			status_did : 0,
			usuario_did : "",
			senha_did : "",
			ip_did : "",
			extensao_did : "",
			/* Codecs */
			codecs : [],
			/* Saida */
			rotas_saida : [],
			/* Configurações */
			callerid : "",
			call_group : "",
			pickup_group : "",
			envio_dtmf : "auto",
			ring_falso : 0,
			nat : 0,
			/* Facilidades */
			pode_monitorar : 0,
			monitoravel : 0,
			//cadeado_pessoal : 0,
			//cadeado_pin : "",
			//num_siga_me : "",
			//cx_postal_pw : "",
			//cx_postal_email : "",

			/* Permissões */
			ligacao_fixo : 0,
			ligacao_internacional : 0,
			ligacao_movel : 0,
			ligacao_ip : 0,
			status : 0
		}

		this.route = _ROUTES_.linhas.store;	
		this.success_message = <div className="alert">
									<h2 className="text-success"><i className="fa fa-check"/>&nbsp;Linha criada com successo !</h2>
								</div>;

		this.onSuccess = () => {
			window.location = "#/linhas";
		}
	}

	render(){
		return (<div>
					<div className="row">
						<div className="col-lg-12">
							<h2 className="page-header">Criar Linha</h2>
						</div>
					</div>
					<div className="panel panel-default">
				    <div className="panel-heading">
				    	<a href="#" className="btn btn-success pull-right" onClick={this.handleFormSubmit}> <i className="fa fa-check"></i> Finalizar </a>
				    	<a href="#/linhas" className="btn btn-warning pull-right mr-2"> <i className="fa fa-arrow-left"></i> Voltar </a>
					</div>
					<div className="panel-body">
						<LinhasForm onInputChange={this.handleInputChange} valuesGetter={this.getValueOf}/>
					</div>
					 {this.getModalToShow()}
				   </div>
				</div>
				);
	}
}

module.exports = LinhasCreate;