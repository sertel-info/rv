<div class="media-line">
  <button type="button" class="close close-right close-media-notification" data-is-flash="{{$notificacao->is_flash}}" data-id="{{$notificacao->id_md5}}" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <div class="alert alert-{{$notificacao->notificacao->nivel}}">
    <div class="media-left">
      <span class="glyphicon {{$notificacao->notificacao->icon_name}}" style="font-size:26px"></span>
    </div>
    <div class="media-body">
      <h5 class="media-heading"> {{$notificacao->notificacao->titulo}} </h5>
      <h6>
        {{$notificacao->mensagem_compilada}}
      </h6>
      <small class='pull-right'>{{$notificacao->formated_created_at}}</small>
    </div>
  </div>
</div>