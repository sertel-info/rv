<div class="col-md-4"></div>
<div class="col-md-4">
	<center>
	<label class="label-control"><h3> Selecione o valor </h3></label>
		<div class="form-group ">	
			<select name="valor_creditos" class='form-control input-lg col-md-3'>
				@foreach($valores_possiveis as $val)
					<option value="{{$val}}"> R$ {{number_format(floatval($val), 2)}} </option>
				@endforeach
			</select>
		</div>
	</center>
</div>
<div class="col-md-4"></div>