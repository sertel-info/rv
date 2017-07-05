<?php

namespace App\Listeners\Filas;

use App\Events\FilaCriada;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CriarFila
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FilaCriada  $event
     * @return void
     */
    public function handle(FilaModificada $event)
    {


    }
}
