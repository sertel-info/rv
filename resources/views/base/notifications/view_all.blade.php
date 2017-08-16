@extends("base.base")

@section("content")

<div class="panel panel-default">
  <div class="panel-heading"> Notificações</div>
  <div class="panel-body">
  	<div class="notifications-body">
	  @if(count($notificacoes) > 0)
	  		@each('base.notifications.notification_line', $notificacoes, 'notificacao')
	  @else
	  		<div class='alert alert-warning block'> Você não possui novas notificações. </div><br>
	  @endif
	</div>
    <center>
    	<a href="#" id="show-more" data-next-page="1" class="btn btn-default"> Exibir antigas </a>
    	<a href="#" id="show-less" data-previous-page="0" class="btn btn-default" style="display:none"> Exibir menos </a></center>
  </div>
</div>

@endsection

@if(count($notificacoes) > 0)
	@push("scripts")
		<script type="text/javascript">
			$(function(){
				$("body").on("click",".close-media-notification", function(){
					var $this = $(this),
						url = "";

					if($this.attr('data-is-flash') == "0"){
						url = "{{route('rvc.notifications.mark.seen')}}";
					} else if($this.attr('data-is-flash') == "1"){
						url = "{{route('rv.notifications.flash.mark.seen')}}";
					}

					if(!$this.parent().hasClass('old')){
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
		           		});
					}
					
	                $this.parents(".media-line").remove();
	                $(".notifications-body").trigger("rv_seen_notification");
				});

				$(".notifications-body").on("rv_seen_notification", function(ev){
					if($(this).find('.media-line').length == 0){
						$(this).html($("<div class='alert alert-warning block'> Você não possui novas notificações. </div><br>"));
					}
				});

			})
		</script>
	@endpush
@endif


@push("scripts")
	<script type="text/javascript">
		$(function(){

				$("#show-more").on("click", function(ev){
					ev.preventDefault();
					var $btn = $(this);
					var next_page = $btn.attr('data-next-page');

					$.ajax({
						url : "{{route('rvc.notifications.get.old')}}/"+next_page,
						method : "GET",
						success : function(resp){
							var notifications = JSON.parse(resp);
							var $container = $(".notifications-body");
							
							if(notifications.length == 0){
								if(next_page == 0){
									$container.append($("<div class='alert alert-warning block'> Você não possui novas notificações. </div><br>"));
								} else {
									$btn.hide();
									return;
								}

							}

							$.map(notifications, function(item, index){
								var notf_html = $(constuctNotificationHtml(item, "close-media-notification"));
								notf_html.addClass("old");
								notf_html.attr("data-page", next_page);
								$container.append(notf_html);
							});

							$btn.attr("data-next-page", parseInt(next_page)+1);
							$btn.html("Exibir Mais");
							$("#show-less").attr('data-previous-page', next_page)
										   .show();
						}
					})
				});


				$("#show-less").on("click", function(ev){
					ev.preventDefault();
					var $btn = $(this);
					var $show_more = $("#show-more");
					var previous_page = $btn.attr("data-previous-page");

					$(".notifications-body").find("[data-page="+previous_page+"]").remove();

					if(!$show_more.is(':visible')){
						$show_more.show();
					}

					$btn.attr("data-previous-page", parseInt(previous_page)-1);
					
					if(previous_page == 1){
						$btn.hide();
						$show_more.html("Exibir antigas");
					}

					$("#show-more").attr("data-next-page", previous_page);
				});
		})
	</script>
@endpush