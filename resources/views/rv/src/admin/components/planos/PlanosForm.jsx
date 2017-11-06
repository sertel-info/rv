import React from 'react';
import MoneyInput from '../../../general/MoneyInput.jsx';

class PlanosForm extends React.Component {
	
	constructor(props){
		super(props);
	}

	render(){
		let valuesGetter = this.props.valuesGetter,
			onChange = this.props.onInputChange;

		return (<div className="container col-lg-6">
                    <div className="form-group row">
						<label htmlFor="pla_nome" className=" col-form-label">Nome</label>
						<input value={valuesGetter("nome")} onChange={onChange} className="form-control input-sm" name="nome" type="text"/>
					</div>

					{/*<div className="form-group row">
						<label htmlFor="pla_tipo" className="col-form-label"> Tipo do Plano  </label>
						<select value={valuesGetter("tipo")} onChange={onChange} className="form-control" name="tipo">
							<option value="pre">PRÉ PAGO</option>
							<option value="pos">PÓS PAGO</option>
						</select>
					</div>*/}

					<div className="form-group row">
						<label htmlFor="pla_val_sms" className="col-form-label "> Valor do SMS  </label>
						<MoneyInput value={valuesGetter("valor_sms")} onChange={onChange} className="form-control input-sm" name="valor_sms" type="text"/>
					</div>

					<div className="form-group row">
						<label htmlFor="pla_val_fx_lc" className="col-form-label "> Valor para fixo local  </label>
 					    <MoneyInput value={valuesGetter("valor_fixo_local")} onChange={onChange} className="form-control input-sm" name="valor_fixo_local" type="text"/>
					</div>

					<div className="form-group row">
						<label htmlFor="pla_val_fixo_ddd" className="col-form-label "> Valor para fixo DDD </label>
						<MoneyInput value={valuesGetter("valor_fixo_ddd")} onChange={onChange} className="form-control input-sm" name="valor_fixo_ddd" type="text"/>

					</div>

					<div className="form-group row">
						<label htmlFor="pla_val_mv_lc" className="col-form-label "> Valor para móvel local  </label>
						<MoneyInput value={valuesGetter("valor_movel_local")} onChange={onChange} className="form-control input-sm" name="valor_movel_local" type="text"/>
					</div>

					<div className="form-group row">
						<label htmlFor="pla_val_mv_ddd" className="col-form-label "> Valor para móvel DDD </label>
						<MoneyInput value={valuesGetter("valor_movel_ddd")} onChange={onChange} className="form-control input-sm" name="valor_movel_ddd" type="text"/>
					</div>

                    <div className="form-group row">
						<label htmlFor="pla_val_ddi" className="col-form-label "> Valor para DDI  </label>
						<MoneyInput value={valuesGetter("valor_ddi")} onChange={onChange} className="form-control input-sm" name="valor_ddi" type="text"/>
					</div>

					<div className="form-group row">
						<label htmlFor="pla_val_ip" className="col-form-label "> Valor para IP  </label>
						<MoneyInput value={valuesGetter("valor_ip")} onChange={onChange} className="form-control input-sm" name="valor_ip" type="text"/>
					</div>


					<div className="form-group row">
						<label htmlFor="pla_val_ip" className="col-form-label "> Valor Fixo Entrante  </label>
						<MoneyInput value={valuesGetter("valor_fixo_entrante")} onChange={onChange} className="form-control input-sm"name="valor_fixo_entrante" type="text"/>
					</div>

					<div className="form-group row">
						<label htmlFor="pla_val_ip" className="col-form-label "> Valor Móvel Entrante  </label>
						<MoneyInput value={valuesGetter("valor_movel_entrante")} onChange={onChange} className="form-control input-sm" name="valor_movel_entrante" type="text"/>
					</div>

					<div className="form-group row">
						<label htmlFor="pla_descricao" className="col-form-label"> Descrição  </label>
						<textarea value={valuesGetter("descricao")} onChange={onChange} className="form-control input-sm" name="descricao" cols="50" rows="10"></textarea>   
					</div>
				</div>
				);
	}
}


module.exports = PlanosForm;