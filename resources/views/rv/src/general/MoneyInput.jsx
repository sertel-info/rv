import React from 'react';
import CurrencyInput from 'react-currency-input';

class MoneyInput extends React.Component {
	
	constructor(props){
		super(props);
	}

	render(){
		return <CurrencyInput onChangeEvent={this.props.onChange} 
							  precision="2" 
							  suffix=" R$" 
							  decimalSeparator="," 
							  thousandSeparator="." 
							  size="20"
							  name={this.props.name}
							  value={this.props.value}
							  className={this.props.className}/>
	}

}

module.exports = MoneyInput;