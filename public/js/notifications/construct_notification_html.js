function constuctNotificationHtml(notf_user, classes=null){

  var html = '<div class="media-line">'+
                        '<button type="button" class="close close-right '+classes+'" data-is-flash="'+notf_user.is_flash+'" data-id="'+notf_user.id_md5+'" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                        '<div class="alert alert-'+notf_user.notificacao.nivel+'">    '+
                          '<div class="media-left">'+
                            '<span class="glyphicon '+notf_user.notificacao.icon_name+'" style="font-size:26px"></span>'+
                          "</div>"+
                          '<div class="media-body">'+
                            '<h5 class="media-heading"> '+notf_user.notificacao.titulo+' </h5>'+
                            "<h6>"+
                            notf_user.mensagem_compilada+
                            "</h6>"+
                            "<small class='pull-right'>"+notf_user.formated_created_at+"</small>"+
                          "</div>"+
                        "</div>"+
                      "</div>";

  return html;
}
