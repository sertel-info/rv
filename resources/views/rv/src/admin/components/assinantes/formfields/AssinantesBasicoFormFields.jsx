import React from 'react';
import AssinantesBasicoPFFormFields from './AssinantesBasicoPFFormFields.jsx';
import AssinantesBasicoPJFormFields from './AssinantesBasicoPJFormFields.jsx';
import RemoteDataSelect from '../../../../general/RemoteDataSelect.jsx';

class AssinantesBasicoFormFields extends React.Component {
	
	constructor(props){
		super(props);
	}

	render(){
		let onInputChange= this.props.onInputChange,
			valuesGetter = this.props.valuesGetter;

		return (<div className="col-lg-6">
					<div className="form-group">
						<label>Tipo</label>
						<select name="tipo" value={valuesGetter("tipo")} onChange={onInputChange} className="form-control" placeholder="">
							<option value="PF"> Pessoa Física </option>
							<option value="PJ"> Pessoa Jurídica</option>
						</select>
					</div>
					{
						valuesGetter("tipo") == "PF" ? <AssinantesBasicoPFFormFields valuesGetter={valuesGetter} onInputChange={onInputChange}/> : <AssinantesBasicoPJFormFields valuesGetter={valuesGetter} onInputChange={onInputChange}/>
					}

					<RemoteDataSelect src={_ROUTES_.planos.get_all} 
										 name="plano" 
										 onChange={onInputChange} 
										 value={valuesGetter("plano")} 
										 className="form-control" 
										 placeholder="">

						<option value="0" disabled> --- Selecione um plano --- </option>
					</RemoteDataSelect>
				</div>
				);
	}
}

module.exports = AssinantesBasicoFormFields;