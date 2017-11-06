
<div class='form-group'> 
	<div class='col-md-6'> 
		<table class='table'>
				 @for($i = 1; $i < 7; $i++)
					<tr> 
					 	<td><p class=''>{{$i}}</p></td> 
					 	<td> 
					 		{{ Form::select("dig_{$i}_tipo", array("0"=>"Nenhum", 
					 										    "ramal"=>"Ramal",
					 										    "grupo"=>"Grupo",
					 										    "fila"=>"Fila"),
					 										    null, 
					 										    ['class'=>'form-control input-sm select_tipo']) }}
					 	</td> 
					 	<td> 
					 	    {{ Form::select("dig_{$i}_destino", 
					 	    		isset($select_opts[strval($i)]) ? $select_opts[strval($i)]: array("0"=>"Nenhum"), null , 
					 	    		['class'=>'form-control input-sm select_destino']) }}
				 	</tr> 
				 @endfor
		</table>
	</div>

	<div class='col-md-6'> 
		<table class='table'>
				
					@foreach([7,8,9,0] as $digito)
					<tr> 
					 	<td><p class=''>{{$digito}}</p></td> 
					 	<td> 
					 		{{ Form::select("dig_{$digito}_tipo", array("0"=>"Nenhum", 
					 										    "ramal"=>"Ramal",
					 										    "grupo"=>"Grupo",
					 										    "fila"=>"Fila"), null,
					 										    ['class'=>'form-control input-sm select_tipo']) }}
					 	</td> 
					 	<td> 
					 	    {{ Form::select("dig_{$digito}_destino", 
					 	    				isset($select_opts[strval($i)]) ? $select_opts[strval($i)]: array("0"=>"Nenhum"),
					 	     				null, 
					 	     				['class'=>'form-control input-sm select_destino']) }}
					    </td>
				 	</tr> 
					 @endforeach
					 <tr> 
						<td><p class=''>#</p></td> 
						<td> 
					 		{{ Form::select("dig_tralha_tipo", array("0"=>"Nenhum", 
					 										    "ramal"=>"Ramal",
					 										    "grupo"=>"Grupo",
					 										    "fila"=>"Fila"), null, 
					 										    ['class'=>'form-control input-sm select_tipo']) }}
					 	</td> 
					 	<td> 
					 	    {{ Form::select("dig_tralha_destino", 
					 	    isset($select_opts['tralha']) ? $select_opts['tralha']: array("0"=>"Nenhum"),
					 	     null, 
					 	    								['class'=>'form-control input-sm select_destino']) }}
					 	</td>
					 </tr>

					  <tr> 
						 	<td ><p class=''>*</p></td> 
						 	<td> 
					 		{{ Form::select("dig_asteristico_tipo", array("0"=>"Nenhum", 
					 										    "ramal"=>"Ramal",
					 										    "grupo"=>"Grupo",
					 										    "fila"=>"Fila"), null, 
					 										    ['class'=>'form-control input-sm select_tipo']) }}
					 		</td>  
					 	<td>
					 	    {{ Form::select("dig_asteristico_destino", 
					 	    isset($select_opts['asteristico']) ? $select_opts['asteristico']: array("0"=>"Nenhum"), null, ['class'=>'form-control input-sm select_destino']) }} 
 						</td>
					 </tr>
				  
			</table>
	</div>
</div>