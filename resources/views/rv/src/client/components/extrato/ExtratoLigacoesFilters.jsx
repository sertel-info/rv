import React from 'react';
import PanelToggleBtn from '../../../general/PanelToggleBtn.jsx';
import ExtratoLigacoesFiltersForm from './ExtratoLigacoesFiltersForm.jsx';
import FilterToggleBtn from '../form_components/FilterToggleBtn.jsx';

class ExtratoLigacoesFilters extends React.Component {
	
	constructor(props){
		super(props);

		this.state = {
			
		}

		//this.handleCollapseClick = this.handleCollapseClick.bind(this);
	}

	/*handleCollapseClick(){
		this.setState({toggled : !this.state.toggled});
	}*/

	render(){
		let ex_filter_content = <ExtratoLigacoesFiltersForm onInputChange={this.props.onInputChange}
												 			valuesGetter={this.props.valuesGetter}/>;

		return (
				<FilterToggleBtn content={ex_filter_content} customBtns={this.props.customBtns}/>
				);
	}
}

module.exports = ExtratoLigacoesFilters;