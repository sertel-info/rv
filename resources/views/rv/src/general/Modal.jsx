import React from 'react';

class Modal extends React.Component {
	
	constructor(props){
		super(props);

		this.state = {
			show: this.props.show !== undefined ? this.props.show : false
		}

		this.handleCancel = this.handleCancel.bind(this);
		this.handleConfirm = this.handleConfirm.bind(this);
		this.handleHide = this.handleHide.bind(this);
		this.handleClickOutside = this.handleClickOutside.bind(this);
	}

	componentDidMount(){
		if(!this.state.show){
			$(this.node).modal('hide');
			return;
		}

		$(this.node).on("mousedown", this.handleClickOutside)

		let $node = $(this.node);
		$node.modal().show();
	}

	componentWillUnmount(){
		$(this.node).unbind("mousedown", this.handleClickOutside);
	}

	componentDidUpdate(){

		if(this.state.show)
			$(this.node).modal().show();
	}

	componentWillReceiveProps(nextProps){
		this.setState({show: nextProps.show,
					   content: nextProps.content});

	}

	handleHide(event){
		$(this.node).modal('hide');
		//this.setState({show : false});
		if(this.props.onHide !== undefined)
			this.props.onHide(event);
	}

    handleClickOutside(event){
		if (this.node && $(event.target).attr("role") == "dialog") {
            this.handleHide(event);
        }
    }

	handleCancel(event){
		$(this.node).modal('hide');
		if(this.props.onCancel !== undefined)
			this.props.onCancel(event);

		this.handleHide(event);
	}

	handleConfirm(event){
		event.preventDefault();
		$(this.node).modal('hide');
		if(this.props.onConfirm !== undefined)
			this.props.onConfirm(event);
	}

	render(){
		if(!this.state.show){
			return null;
		}

		let ref = this.props.customRef == undefined ? ref=(div) => { this.node = div } : this.props.customRef;

		return (<div ref={ref} data-backdrop="static" id={this.props.id} className="modal fade" tabIndex="-1" role="dialog">
						<div className="modal-dialog" role="document">
						    <div className="modal-content">
						      <div className="modal-header dark-overlay">
						        <button type="button" onClick={this.handleHide} className="close" aria-label="Close"><span aria-hidden="true" className="fa fa-close fa-2x"></span></button>
						        <h4 className="modal-title"> {this.props.title} </h4>
						      </div>
						      <div className="modal-body">
						      	  {this.props.content}
						      </div>
						      <div className="modal-footer">
						       {this.props.cancelable ? <button onClick={this.handleCancel} type="button" className="btn btn-default" data-dismiss="modal">{this.props.cancelLabel}</button> : ""}
						       {this.props.confirmable ?  <a onClick={this.handleConfirm} href='#' type="button" className="btn btn-primary">{this.props.confirmLabel}</a> : "" }
						       {this.props.customBtns !== undefined ? this.props.customBtns : ""}
						      </div>
						    </div>
						</div>
				</div>);
	}
}

module.exports = Modal;