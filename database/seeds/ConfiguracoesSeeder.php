<?php

use Illuminate\Database\Seeder;
use App\Models\Configuracoes;

class ConfiguracoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config = new Configuracoes;

        $config->create([
	        	"prefx_aplicacoes"=>"*",
                'atalho_siga_me'=>"123",
                'atalho_cadeado'=>"1234",
                "voice_mail_assunto_padrao"=>"Você tem uma nova mensagem na caixa postal !",
                "voice_mail_remetente_padrao"=>"correio-voz@sertel-info.com.br",
                "voice_mail_mensagem_padrao"=>"Segue em anexo a mensagem deixada em sua caixa postal!"
        ]);
    }
}
