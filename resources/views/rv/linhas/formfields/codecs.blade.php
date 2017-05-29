
<div class="panel panel-default panel-toggle">
    <div class="panel-heading" data-toggle="collapse" data-target="#body-codecs">
        <h3 class="panel-title">Codecs 
	        <div class="collapse-icon pull-right">
	        	<span class="glyphicon glyphicon-circle-arrow-down"> </span>
	        </div>
        </h3>
    </div>
    
    <div class="panel-body collapse"  id="body-codecs">
        <div class='row' id="codecs-picklist">
          <div class='col-sm-5'>
            <select class='form-control pickListSelect pickData' multiple>
                @foreach($codecs as $codec)
                    <option value="{{$codec}}"> {{$codec}} </option>
                @endforeach
            </select>
         </div>
         <div class='col-sm-2 pickListButtons'>
           <button class='pAdd btn btn-primary btn-sm'> Adicionar </button>
           <button class='pRemove btn btn-primary btn-sm'> Remover </button>
           <button class='pRemoveAll btn btn-primary btn-sm'> Remover Todos</button>
         </div>
         <div class='col-sm-5'>
            <select class='form-control pickListSelect pickListResult' multiple name='codecs[]'>
                @if(isset($codecs_added))
                    @foreach($codecs_added as $codec)
                        <option value="{{$codec}}"> {{$codec}} </option>
                    @endforeach
                @endif
            </select>
         </div>
        </div>
	</div>
</div>
