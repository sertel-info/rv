import React from 'react';
import FilterToggleBtn from '../form_components/FilterToggleBtn.jsx';
import GravacoesFiltersForm from './GravacoesFiltersForm.jsx';

class GravacoesFilters extends React.Component {
	
	constructor(props){
		super(props);

	}

	render(){
		let ex_filter_content = <GravacoesFiltersForm onInputChange={this.props.onInputChange}
												 			valuesGetter={this.props.valuesGetter}/>;

		return (
				<FilterToggleBtn content={ex_filter_content} customBtns={this.props.customBtns}/>
				);
	}
}

module.exports = GravacoesFilters;