<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
//use Illuminate\Queue\SerializesModels;
//use Illuminate\Broadcasting\PrivateChannel;
//use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
//use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UraAtualizada
{
    //use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    //public $usuario;
    //public $senha;
    
    public function __construct($assinante_id, $ura_id)
    {
        $this->assinante = $assinante_id;
        $this->ura = $ura_id;
    }
}
