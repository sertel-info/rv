import React from 'react';

class PickList extends React.Component {
	
	constructor(props){
		super(props);
		
		let added = [],
			not_added = this.props.options;
		
		console.log("opts", this.props.options);
		if(this.props.value !== undefined){
			    added = this.props.options.filter(function(el){ return this.props.value.indexOf(el.value) !== -1 }.bind(this));
				not_added = this.props.options.filter(function(el){ return this.props.value.indexOf(el.value) == -1 }.bind(this));
		}

		this.state = {
			options : this.props.options,
			added: added,
			not_added : not_added,
			markedToAdd : {},
			markedToRemove: {}
		}

		this.handleToAddChange = this.handleToAddChange.bind(this);
		this.handleAdd = this.handleAdd.bind(this);
		this.handleRemove = this.handleRemove.bind(this);
		this.handleToRemoveChange = this.handleToRemoveChange.bind(this);
		this.handleRemoveAll = this.handleRemoveAll.bind(this);
		this.handleChange = this.handleChange.bind(this);
	}

	componentWillReceiveProps(nextProps){
		let added = [],
			not_added = nextProps.options;
		
		console.log('nextProps', nextProps);

		if(nextProps.value !== undefined){
			    added = nextProps.options.filter(function(el){ return nextProps.value.indexOf(el.value) !== -1 }.bind(this));
				not_added = nextProps.options.filter(function(el){ return nextProps.value.indexOf(el.value) == -1 }.bind(this));
		}

		this.setState({
			options : nextProps.options,
			added: added,
			not_added : not_added
		});
	}

	handleToAddChange(event){
		event.preventDefault();
		let value = event.target.value,
		    option = this.state.options.filter(function(opt, i){
				return opt.value == value;
			});

		this.setState({markedToAdd: option[0]});
	}

	handleToRemoveChange(event){
		event.preventDefault();
		let value = event.target.value,
		    option = this.state.options.filter(function(opt, i){
				return opt.value == value;
			});

		this.setState({markedToRemove: option[0]});
	}

	handleAdd(event){
		event.preventDefault();
		let to_add = this.state.markedToAdd,
			added = this.state.added,
			not_added = this.state.not_added;

		added = added.concat(to_add);

		//checa se existe algo marcado para remover
		if(Object.keys(to_add).length == 0)
			return;
		
		not_added = not_added.filter(function(el, i){
			return el.value !== to_add.value
		});

		this.setState({
			not_added : not_added,
			added : added,
			markedToAdd : {},
		}, () => this.handleChange(event));

	}

	handleRemove(event){
		event.preventDefault();
		let to_rmv = this.state.markedToRemove,
			added = this.state.added,
			not_added = this.state.not_added;

		//checa se existe algo marcado para remover
		if(Object.keys(to_rmv).length == 0)
			return;

		not_added = not_added.concat(to_rmv);

		added = added.filter(function(el, i){
			return el.value !== to_rmv.value;
		});

		this.setState({
			not_added : this.getSortedByTitle(not_added),
			added : added,
			markedToRemove : {},
			markedToAdd: {}
		}, () => this.handleChange(event));

		
	}

	handleChange (event){
		let ev_custom_data = {is_pick_list: true,
							  pl_value: this.state.added.map(function(el, i){ return el.value }),
							  target : document.getElementsByName(this.props.name)[0]},
			custom_ev = new CustomEvent('pl_change', {detail : ev_custom_data});
		
		this.props.onChange(custom_ev);
	}

	handleRemoveAll(event){
		event.preventDefault();
		let added = this.state.added,
			not_added = this.state.not_added;
 
		this.setState({
			markedToAdd : {},
			markedToRemove : {},
			not_added : not_added.concat(added),
			added : []
		}, () => this.handleChange(event));
	}

	getSortedByTitle(array){
		return array.sort(function(a, b){ 
			if(a.title < b.title)
				return -1;
			if(a.title > b.title)
				return 1;

			return 0;
		});
	}

	render(){
		console.log("added", this.state.added)
		return (<div className="col-lg-12">
					<select value={[this.state.markedToAdd.value]} multiple onChange={this.handleToAddChange} className="col-lg-5" style={{minHeight:'200px'}}>
						{this.state.not_added.map(function(codec,i){ return <option key={i} value={codec.value}> {codec.title} </option> })}
					</select>
					<div className="col-lg-2" style={{textAlign:"center"}}>
						<a href="#" className="btn btn-default mt-1" onClick={this.handleAdd}> Adicionar </a>
						<a href="#" className="btn btn-default mt-3" onClick={this.handleRemove}> Remover </a>
						<a href="#" className="btn btn-default mt-3" onClick={this.handleRemoveAll}> Remover todos </a>
					</div>
					<select name={this.props.name} multiple value={[this.state.markedToRemove.value]} onChange={this.handleToRemoveChange} className="col-lg-5" style={{minHeight:'200px'}}>
						{this.state.added.map(function(codec,i){ return <option key={i} value={codec.value}> {codec.title} </option> })}
					</select>
				</div>);
	}
}

module.exports = PickList;