import React from 'react';
import FormInterface from '../../../general/FormInterface.jsx';
import LinhasForm from './LinhasForm.jsx';
import Axios from 'axios';

class LinhasEdit extends FormInterface {
	
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

		this.route = _ROUTES_.linhas.update;
		try{
			this.params = {"l": this.props.location.params.linha};
		} catch (e){
			window.location = "#/linhas";
		}
		this.success_message = <div className="alert">
									<h2 className="text-success"><i className="fa fa-check"/>&nbsp;Linha atualizada com successo !</h2>
								</div>;

		this.onSuccess = () => {
			window.location = "#/linhas";
		}

		this.getRemoteData = this.getRemoteData.bind(this);
	}

	componentDidMount(){
		this.getRemoteData();
	}

	getRemoteData(){
		let linha_id;

		try{
			 linha_id = this.props.location.params.linha;
		} catch (e){
			window.location = "#/linhas";
		}
		
		Axios({
			
			method: "GET",
			url: _ROUTES_.linhas.get,
			params : {l : linha_id}

		}).then(function(response){
			let linha = response.data.linha,
				autenticacao = linha.autenticacao,
				configuracoes = linha.configuracoes,
				did = linha.did,
				permissoes = linha.permissoes,
				facilidades = linha.facilidades,
				new_state = {
							nome : linha.nome,
							assinante : linha.assinante_id,
							plano: linha.plano == null ? "assinante" : linha.plano,
							ddd_local:linha.ddd_local,
							simultaneas:linha.simultaneas,
							status_did: linha.status_did,
							cli: linha.cli,
							codecs : linha.codecs
							};

				if(autenticacao !== null){
					new_state = Object.assign(new_state, {
						login_ata : autenticacao.login_ata,
						usuario : autenticacao.usuario,
						senha: autenticacao.senha,
						ip: autenticacao.ip,
						porta: autenticacao.porta,
					})
				}

				if(did !== null){
					new_state = Object.assign(new_state, {
						status_did: did.status_did,
						usuario_did: did.usuario_did,
						senha_did: did.senha_did,
						ip_did: did.ip_did,
						extensao_did: did.extensao_did
					})
				}

				if(configuracoes !== null){
					new_state = Object.assign(new_state, {
						rotas_saida : configuracoes.rotas_saida,
						callerid: configuracoes.callerid,
						call_group: configuracoes.call_group,
						pickup_group: configuracoes.pickup_group,
						envio_dtmf: configuracoes.envio_dtmf,
						ring_falso: configuracoes.ring_falso,
						nat: configuracoes.nat
					})
				}
				
				if(facilidades !== null){
					new_state = Object.assign(new_state, {
						perm_gravacao  : facilidades.perm_gravacao,
						perm_siga_me : facilidades.perm_siga_me,
						perm_cx_postal : facilidades.perm_cx_postal,
						perm_at_automatico : facilidades.perm_at_automatico,
						perm_cadeado : facilidades.perm_cadeado,
						gravacao : facilidades.gravacao,
						cadeado_pessoal : facilidades.cadeado_pessoal,
						siga_me : facilidades.siga_me,
						caixa_postal : facilidades.caixa_postal,
						cadeado_pin : facilidades.cadeado_pin,
						pode_monitorar : facilidades.pode_monitorar,
						monitoravel : facilidades.monitoravel,
						num_siga_me : facilidades.num_siga_me,
						cx_postal_pw : facilidades.cx_postal_pw,
						cx_postal_email : facilidades.cx_postal_email
					});
				}


				if(permissoes !== null){
					new_state = Object.assign(new_state, {
						ligacao_fixo : permissoes.ligacao_fixo,
						ligacao_internacional : permissoes.ligacao_internacional,
						ligacao_movel : permissoes.ligacao_movel,
						ligacao_ip : permissoes.ligacao_ip,
						status :permissoes.status
					});
				}
			this.setState(new_state);

		}.bind(this)).catch(function(error){
			
			console.log(error);

		}.bind(this));
	}

	render(){
		return (<div>
					<div className="row">
						<div className="col-lg-12">
							<h2 className="page-header">Editar Linha</h2>
						</div>
					</div>
					<div className="panel panel-default">
					    <div className="panel-heading">
					    	Editar Linha
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

module.exports = LinhasEdit;