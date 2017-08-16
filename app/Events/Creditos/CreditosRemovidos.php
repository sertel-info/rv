<?php

namespace App\Events\Creditos;

use Illuminate\Queue\SerializesModels;
use App\Models\Assinantes\Assinantes;
use Illuminate\Http\Request;

class CreditosRemovidos
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    private $request;
    private $assinante;
    
    public function __construct(Assinantes $assinante, Request $request)
    {
        $this->request = $request;
        $this->assinante = $assinante;
    }

    public function getAssinante(){
        return $this->assinante;
    }

    public function getRequest(){
        return $this->request;
    }

}
