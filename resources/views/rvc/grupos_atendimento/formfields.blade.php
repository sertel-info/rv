
 {{csrf_field()}}
 <div class='row form-horizontal'>
        	<div class='form-group'>
	        	<label class='control-label col-md-3'> Nome: </label>
	    		<div class='col-md-5'>
		    		{{Form::text('nome', null, ['class'=>'form-control'])}}
	    		</div>
	    	</div>
            <div class='form-group'>
                <label class='control-label col-md-3'> Tipo: </label>
                
                <div class='col-md-5'>
                   {{ Form::select('tipo', array('hierarquico' => 'Hierárquico',
                                                      'distribuidor' => 'Distribuidor',
                                                      'multiplo'=>'Múltiplo'),
                                                      null,
                                                array('class'=>'form-control')) }}
                </div>


            </div>
            <div class='form-group'>
                <label class='control-label col-md-3'> Tempo de chamada: </label>
                
                <div class='col-md-5'>
                   {{ Form::select('tempo_chamada', array( 10 => '10 segundos',
                                                  20 => '20 segundos',
                                                  30 => '30 segundos',
                                                  40 => '40 segundos',
                                                  50 => '50 segundos',
                                                  60 => '60 segundos',
                                                  70 => '70 segundos',
                                                  80 => '80 segundos',
                                                  90 => '90 segundos',
                                                  100 => '100 segundos'),
                                                  null,
                                                array('class'=>'form-control')) }}
                </div>

                
            </div>
    	</div>
    	<hr>
        <div class='row' id="linhas-picklist">
          <div class='col-md-5'>

            <select class='form-control pickListSelect pickData' multiple>
                @if(isset($linhas))
	                @foreach($linhas as $linha)
	                    <option value="{{$linha->id_md5}}"> {{$linha->nome}} </option>
	                @endforeach
                @endif
            </select>
         </div>
         <div class='col-md-2 pickListButtons'>
           <button class='pAdd btn btn-primary btn-sm'> Adicionar </button>
           <button class='pRemove btn btn-primary btn-sm'> Remover </button>
           <button class='pRemoveAll btn btn-primary btn-sm'> Remover Todos</button>
         </div>
         <div class='col-md-5'>
            <select class='form-control pickListSelect pickListResult' multiple name='linhas[]'>
                @if(isset($linhas_added))
                    @foreach($linhas_added as $linha)
                        <option value="{{$linha->id_md5}}"> {{$linha->nome}} </option>
                    @endforeach
                @endif
            </select>
         </div>
        </div>




@push("scripts")
  <script type="text/javascript">
    
    $(function(){
      var linhasPickList = $("#linhas-picklist");

        linhasPickList.find(".pAdd").on('click', function(ev) {
          ev.preventDefault();
          var p = linhasPickList.find(".pickData option:selected");
          p.clone().appendTo(linhasPickList.find(".pickListResult"));
          p.remove();
        });

        linhasPickList.find(".pRemove").on('click', function(ev) {
          ev.preventDefault();
          var p = linhasPickList.find(".pickListResult option:selected");
          p.clone().appendTo(linhasPickList.find(".pickData"));
          p.remove();
        });

        linhasPickList.find(".pRemoveAll").on('click', function(ev) {
          ev.preventDefault();
          var p = linhasPickList.find(".pickListResult option");
          p.clone().appendTo(linhasPickList.find(".pickData"));
          p.remove();
        });

        $("#form-grupos").on("submit", function(ev){
          $(".pickListResult option").prop("selected", true);
        });
    });

    

  </script>
@endpush