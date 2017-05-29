<?php

use Illuminate\Database\Seeder;

use App\Models\Assinantes\Assinantes;
use App\Models\Linhas\Linhas;
use App\Models\Linhas\DadosAutenticacaoLinhas;
use App\Models\Linhas\DadosCodecsLinhas;
use App\Models\Linhas\DadosConfiguracoesLinhas;
use App\Models\Linhas\DadosFacilidadesLinhas;
use App\Models\Linhas\DadosPermissoesLinhas;
use App\Models\Linhas\Dids;

class LinhasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $linhas = factory(Linhas::class, 10)
                            ->create()
                            ->each(function($linha){
                                    $linha->autenticacao()->save(factory(DadosAutenticacaoLinhas::class)->make());
                                    $linha->configuracoes()->save(factory(DadosConfiguracoesLinhas::class)->make());
                                    $linha->facilidades()->save(factory(DadosFacilidadesLinhas::class)->make());
                                    $linha->permissoes()->save(factory(DadosPermissoesLinhas::class)->make());
                                    if($linha->status_did){
                                        $linha->did()->save(factory(Dids::class)->make());
                                    }
                            });
    }

}