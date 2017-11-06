import React from 'react';

class MultiForm extends React.Component {
	
	constructor(props){
		super(props);

		this.props = props;
		this.state = {
			active: 0
		};

		this.handlePillClick = this.handlePillClick.bind(this);
	}

	handlePillClick(event, index){
		event.preventDefault();
		event.target.blur();
		this.setState({active:index});
	}

	render(){
		let header_btns = [];
		this.props.stages.map(function(el, index){
			header_btns.push(
							
							 <li key={index} className={this.state.active == index ? "active" : ""}>
								<a href="#" aria-expanded="true" onClick={(event) => this.handlePillClick(event, index)}>
			                    	<span style={{fontSize:'0.8em'}}>{el.title} {el.error ? <i class="fa fa-plus"/> : "" }</span>
			                 	</a>
			                 </li>
			                 );

		}.bind(this));
		
		return (<div className="panel panel-default">
					<div className="panel-heading tabs" style={{height:"80px"}}>
					        <div className="col-lg-12">
					            <ul className="nav nav-pills">
					            	{header_btns}
					            </ul>
					        </div>
					</div>
					<div className="panel-body">
						{this.props.stages[this.state.active].content}
					</div>
				</div>);
	}
}

module.exports = MultiForm;