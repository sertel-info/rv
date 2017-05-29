<div class="modal {{$class or ''}} fade" tabindex="-1" role="dialog" id="{{$id or ''}}">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ $title or '' }}</h4>
      </div>
      <div class="modal-body" style="text-align:center">
        @if(isset($body))
            {{ $body }}
        @endif
      </div>
      <div class="modal-footer">
        @if(!isset($footer))
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        @else
          {{ $footer }}
        @endif
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->