
{{csrf_field()}}
<div class='row form-horizontal'>
        
        <div class='form-group'>
	        <label class='control-label col-md-3'> Linha : </label>
	    	<div class='col-md-5'>
		   		{{Form::select("nome", [], null, ['class'=>'form-control'])}}
	    	</div>
	   </div> 

</div>
