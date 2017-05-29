<?php

use Illuminate\Database\Seeder;

use App\Models\Assinantes\Assinantes;
use App\Models\Assinantes\DadosFinanceiroAssinante;
use App\Models\Assinantes\DadosFacilidadesAssinante;
use App\Models\Assinantes\DadosAcessoAssinante;
use App\Models\Assinantes\DadosContatoAssinante;
use App\User;

class AssinantesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $assinantes = factory(Assinantes::class, 5)
                            ->states("pessoa_fisica")
                            ->create()
                            ->each(function($assinante){
                                $assinante->contato()
                                          ->save(factory(DadosContatoAssinante::class)->make());

                                $assinante->financeiro()
                                          ->save(factory(DadosFinanceiroAssinante::class)->make());
                                            
                                $assinante->facilidades()
                                          ->save(factory(DadosFacilidadesAssinante::class)->make());
                                            
                                $assinante->acesso()
                                          ->save(factory(User::class)->make());
                            });
        
        $assinantes = factory(Assinantes::class, 5)
                            ->states("pessoa_juridica")
                            ->create()
                            ->each(function($assinante){
                                $assinante->contato()
                                          ->save(factory(DadosContatoAssinante::class)->make());

                                $assinante->financeiro()
                                          ->save(factory(DadosFinanceiroAssinante::class)->make());
                                            
                                $assinante->facilidades()
                                          ->save(factory(DadosFacilidadesAssinante::class)->make());
                                            
                                $assinante->acesso()
                                          ->save(factory(User::class)->make());
                            });
    }
}
