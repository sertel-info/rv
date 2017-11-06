<div class="panel panel-default panel-toggle">
    <div class="panel-heading" data-toggle="collapse" data-target="#body-permissoes">
        <h3 class="panel-title"> Permissões 
	        <div class="collapse-icon pull-right">
	        	<span class="glyphicon glyphicon-circle-arrow-down"> </span>
	        </div>
        </h3>
    </div>
    
    <div class="panel-body collapse" id="body-permissoes">
        
                    <div class="form-group row">
						
						<div class='col-md-6'>
							<center>
								<label for="ligacao_fixo" id="transferencia" class=""> Ligação para FIXO </label><br>
								{{Form::checkbox('ligacao_fixo', 1, null, ['class'=>'form-control'])}}
							</center>
						</div>

						<div class='col-md-6'>
							<center>
								<label for="ligacao_movel" class=""> Ligação para MÓVEL  </label><br>
								{{Form::checkbox('ligacao_movel', 1, null, ['class'=>'form-control'])}}
							</center>
						</div>

						
					</div>
					
					<div class="form-group row">
						<div class='col-md-6'>
								<center>
									<label for="ligacao_internacional" class=""> Ligação Internacional  </label><br>
									{{Form::checkbox('ligacao_internacional', 1, null, ['class'=>'form-control'])}}
								</center>
						</div>
						
						<div class='col-md-6'>
							<center>
								<label for="ligacao_ip" class=""> Ligação IP x IP </label><br>
								{{Form::checkbox('ligacao_ip', 1, null, ['class'=>'form-control'])}}
							</center>
						</div>

					</div>

					<div class="form-group row">
						<div class='col-md-6'>
								<center>
									<label for="status" class=""> Status  </label><br>
								    {{Form::checkbox('status', 1, null, ['class'=>'form-control'])}}
								</center>
						</div>

					</div>

	</div>
</div>

