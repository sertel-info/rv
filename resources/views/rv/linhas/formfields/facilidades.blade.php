<div class="panel panel-default panel-toggle">
    <div class="panel-heading" data-toggle="collapse" data-target="#body-facilidades">
        <h3 class="panel-title">Facilidades e Funcionalidades
          	<div class="collapse-icon pull-right">
        		<span class="glyphicon glyphicon-circle-arrow-down"> </span>
       		</div>
        </h3>
    </div>

    <div class="panel-body collapse" id="body-facilidades">

					
					<div class="form-group row">
						<div class='col-md-4'>
								<center>
									<label for="gravacao" class=""> Gravação  </label><br>
									{{Form::checkbox('gravacao', 1, null, ['class'=>'form-control'])}}
								</center>
						</div>
					</div>
					<div class="form-group row">
						<div class='col-md-4 '>
							<center>
								<label for="cadeado_pessoal" class=""> Cadeado pessoal </label><br>
								{{Form::checkbox('cadeado_pessoal', 1, null, ['class'=>'form-control'])}}
							</center>
						</div>
	
						<div class='col-md-8 collapse'>
								<div class='col-md-6'>
									<label for="cadeado_pin"> PIN </label><br>
									{{Form::text("cadeado_pin", null, ['class'=>'form-control'])}}
								</div>				
						</div>
					</div>

					<div class="form-group row">
						<div class='col-md-4 '>
							<center>
									<label for="caixa_postal" class=""> Caixa Postal </label><br>
									{{Form::checkbox('caixa_postal', 1, null, ['class'=>'form-control'])}}
							</center>
						</div>
	
						<div class='col-md-8 collapse'>
								<div class='col-md-6'>
									<label for="cx_postal_pw"> Senha de acesso </label><br>
									{{Form::text("cx_postal_pw", null, ['class'=>'form-control'])}}
								</div>
								<div class='col-md-6 '>
									<label for="cx_postal_pw"> Email </label><br>
									{{Form::text("cx_postal_email", null, ['class'=>'form-control'])}}	
								</div>											
						</div>
					</div>

					<div class="form-group row">
						<div class='col-md-4 '>
							<center>
								<label for="siga_me" class=""> Siga-me </label> <br>
								{{Form::checkbox('siga_me', 1, null, ['class'=>'form-control'])}}
							</center>
						</div>
	
						<div class='col-md-8 collapse'>
								<div class='col-md-6'>
									<label for="num_siga_me"> Número </label><br>
									{{Form::text("num_siga_me", null, ['class'=>'form-control'])}}
								</div>						
						</div>
					</div>


	</div>

</div>
