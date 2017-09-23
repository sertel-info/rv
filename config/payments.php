<?php

return array(
			 "valores_possiveis"=>[ 25, 30, 50, 100, 500, 1000 ],

			 "CLIENT_ID"=>"7238398990030539",
			 "CLIENT_SECRET"=>"S1ZIo9vXrrrdVZ93YSbHlTOPm1gHD3jU",
			 "ACCESS_TOKEN"=>"APP_USR-7238398990030539-071115-48f34937d0e71b8f61c8403788b81514__LC_LA__-3880297",
			 
			 //rota para a qual será enviada a notificação de que um novo pagamento ocorreu
			 "notification_url"=> "http://".config('app.url')."/pagamentos/notification/check",
    		 
    		 //rotas que serão chamadas depois do processo
    		 "back_urls"=> array("success"=> "http://".config('app.url')."/pagamentos/finished?status=success",
    							 "pending"=> "http://".config('app.url')."/pagamentos/finished?status=pending",
    							 "failure"=> "http://".config('app.url')."/pagamentos/finished?status=failure"),
    		 
    		 //"sandbox_init_point" para o sandbox e "init_point" para o modo produção
    		 "init_point"=>"init_point"
    		);

