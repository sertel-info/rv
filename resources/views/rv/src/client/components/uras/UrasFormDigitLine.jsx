import React from 'react';

class UrasFormDigitLine extends React.Component {
	
	constructor(props){
		super(props);

		this.state = {
			digit : this.props.digit;
		}
	}

	render(){
		return (<tr> 
					<td>
						<select onChange={this.onChange} values={this.valuesGetter(this.digit.concat("_tipo"))}>
							<option>
							</option>
						</select>
					</td>
				</tr>);
	}
}

module.exports = UrasFormDigitLine;