<li> 
    <!-- <a class="btn-lg" role="button" data-container="body" data-toggle="popover" data-placement="bottom" id="notifications-btn">
       <span class='glyphicon glyphicon-exclamation-sign gi-1x' aria-hidden="true" ></span>
    </a>  -->

    <a class="btn-lg" role="button" id="notifications-btn" href="{{route('rvc.notifications.view.all')}}">
       <span class='glyphicon glyphicon-exclamation-sign gi-1x' aria-hidden="true" ></span>
    </a> 
</li>

<div id="notifications-container" style="display:none">
  <div id="notifications-popover">
    <center><img src="/ajax-loader.gif" class="loading"/></center>
    <div class="media">
    </div>
    
  </div>
  <a class='btn btn-default btn-block' href="{{route('rvc.notifications.view.all')}}" style="min-width:244px !important">
      <span class='glyphicon glyphicon-plus' aria-hidden="true"></span>
      Visualizar todas
  </a>

</div>

@push("scripts")
  <script type="text/javascript" src="/js/notifications/construct_notification_html.js"></script>
  <script type="text/javascript">
      $(function(){
        
        /*function startNotfPopover(){
          var popover_content = $("#notifications-container");

          $("[data-toggle=popover]").popover({
                  title: "Notificações",
                  content: popover_content.html(),
                  html: true
          }).on("hidden.bs.popover", function(ev){
              $("[data-toggle=popover]").popover("destroy");
          }).on("show.bs.popover", function(){
              startNotfPopover();
          });

          //popover_content.remove();
        }*/


        /** Verifica se existem novas notificações **/
        $.ajax({
          url: "{{route('rvc.notifications.check.new')}}",
          method: "GET",
          success: function(resp){
             resp = JSON.parse(resp);

             if(resp.has_new){
                $("#notifications-btn span").addClass('text-danger');
             }
          }
        });

        /*
        $.ajax({
          url: "{{route('rvc.notifications.get.my.new')}}",
          method: "GET",
          success: function(resp){
              resp = JSON.parse(resp);

              if(resp.status !== 1){
                $.toaster({ priority : "danger",
                            title : "Erro",
                            message : "Um erro ocorreu, tente novamente",
                          });
                return;
              }

              var notificacoes_html = "";
              var notf_user;

              for(var i=0; i<3; i++){
                 if(resp.notificacoes[i] == undefined){
                    break;
                 }

                 notf_user = resp.notificacoes[i];
                 notificacoes_html += constuctNotificationHtml(notf_user, "close-media-notification-popover");
              }

              //
              //  Verifica se existem mais de 3 
              //  exibe o botão para visualizar os que sobraram
              //  e cacheia as notificações de índice > 3
              //

              if(resp.notificacoes.length > 3){
                  $("#notifications-container .media").after('<div class="">'+
                                                              '<center><a href="#" id="overflow"><h5> Mais <span id="overflow-count">'+(resp.notificacoes.length-3)+'</span> ... </h5></a></center>'+
                                                           '</div>');

                  window.sessionStorage.setItem("more_notifications",
                                                JSON.stringify(resp.notificacoes.slice(3)));
              }
              
              $("#notifications-container .loading").remove();
              $("#notifications-container .media").html(notificacoes_html);
          }

        }).done(function(){
              startNotfPopover();
              var popover_content = $("#notifications-container");

              $('body').on("click", '.close-media-notification-popover', function(){
                //diminui 1 no contador do "Mais X ..."
                  var popo_content = $($("[data-toggle=popover]").data('bs.popover').options.content);

                  var oflow = $("#overflow"),
                      $this = $(this);

                  if(oflow.length > 0){
                    var count = $("#overflow-count");
                    var curr_val = parseInt(count.html());
                    var new_val = curr_val-1;

                    if(new_val == 0){
                        oflow.remove();
                        popo_content.find("#overflow").remove();
                    } else {
                        count.html(new_val);
                    }
                  }

                  
                  //  verifica se tem notificacoes cacheadas para serem exibidas
                  //  se houver, exibe a próxima;
                  
                  var more_notifications = window.sessionStorage.getItem("more_notifications");
                  if(more_notifications !== null){
                      more_notifications = JSON.parse(more_notifications);
                      var next_notification = more_notifications.shift();
                      $("#notifications-popover .media").append(constuctNotificationHtml(next_notification, "close-media-notification-popover"));
                      
                      if(more_notifications.length > 0){
                        sessionStorage.setItem("more_notifications", JSON.stringify(more_notifications));
                      } else {
                        sessionStorage.removeItem("more_notifications");                      
                      }
                  }

                  var url = "";
                  if($this.attr('data-is-flash') == "0"){
                    url = "{{route('rvc.notifications.mark.seen')}}";
                  } else if($this.attr('data-is-flash') == "1"){
                    url = "{{route('rv.notifications.flash.mark.seen')}}";
                  }

                  $.ajax({
                    url : url,
                    data : { "n": $this.attr("data-id"), "_token": "{{csrf_token()}}" },
                    method : "POST",
                    success : function(resp){
                       resp = JSON.parse(resp);

                       if(!resp.status == 1){
                          $.toaster({ priority : "danger",
                                      title : "Erro",
                                      message : "Um erro ocorreu, tente novamente",
                          });
                       }

                    }
                  })

                  $(this).parents(".media-line").remove();
                  
                  popover_content.find(".close-media-notification-popover[data-id="+$this.attr("data-id")+"]")
                                    .parents('.media-line:first')
                                    .remove();

                  //startNotfPopover();
                  //$("[data-toggle=popover]").data('bs.popover').options.content = popo_content;
              });
        });*/

      });
  </script>
@endpush
