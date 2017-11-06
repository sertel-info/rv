
<div class="panel panel-default panel-toggle">
    <div class="panel-heading" data-toggle="collapse" data-target="#body-rotas">
        <h3 class="panel-title"> Rota de saída 
	        <div class="collapse-icon pull-right">
	        	<span class="glyphicon glyphicon-circle-arrow-down"> </span>
	        </div>
        </h3>
    </div>
    
    <div class="panel-body collapse"  id="body-rotas">
        <div class='row' id="rotas-picklist">
          <div class='col-sm-5'>
            <select class='form-control pickListSelect pickData' multiple>
                <option value="EBS"> EBS </option>
                @foreach($rotas as $rota)
                    <option value="{{$rota}}"> {{$rota}} </option>
                @endforeach
            </select>
         </div>
         <div class='col-sm-2 pickListButtons'>
           <button class='pAdd btn btn-primary btn-sm'> Adicionar </button>
           <button class='pRemove btn btn-primary btn-sm'> Remover </button>
           <button class='pRemoveAll btn btn-primary btn-sm'> Remover Todos</button>
         </div>
         <div class='col-sm-5'>
            <select class='form-control pickListSelect pickListResult' multiple name='rotas_saida[]'>
                @if(isset($rotas_added))
                    @foreach($rotas_added as $rota)
                        <option value="{{$rota}}"> {{$rota}} </option>
                    @endforeach
                @endif
            </select>
         </div>
        </div>
	</div>
</div>
