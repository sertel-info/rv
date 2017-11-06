<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute deve ser aceito.',
    'active_url'           => ':attribute não é uma URL válida.',
    'after'                => ':attribute deve ser uma data depois de :date.',
    'alpha'                => ':attribute deve conter somente letras.',
    'alpha_dash'           => ':attribute deve conter letras, números e traços.',
    'alpha_num'            => ':attribute deve conter somente letras e números.',
    'array'                => ':attribute deve ser um array.',
    'before'               => ':attribute deve ser uma data antes de :date.',
    'between'              => [
        'numeric' => ':attribute deve estar entre :min e :max.',
        'file'    => ':attribute deve estar entre :min e :max kilobytes.',
        'string'  => ':attribute deve estar entre :min e :max caracteres.',
        'array'   => ':attribute deve ter entre :min e :max itens.',
    ],
    'boolean'              => ':attribute deve ser verdadeiro ou falso.',
    'confirmed'            => 'A confirmação de :attribute não confere.',
    'date'                 => ':attribute não é uma data válida.',
    'date_format'          => ':attribute não confere com o formato :format.',
    'different'            => ':attribute e :other devem ser diferentes.',
    'digits'               => ':attribute deve ter :digits dígitos.',
    'digits_between'       => ':attribute deve ter entre :min e :max dígitos.',
    'dimensions'           => ':attribute não tem dimensões válidas.',
    'distinct'             => ':attribute campo contém um valor duplicado.',
    'email'                => ':attribute deve ser um endereço de e-mail válido.',
    'exists'               => ':attribute selecionado é inválido.',
    'file'                 => ':attribute precisa ser um arquivo.',
    'filled'               => ':attribute é um campo obrigatório.',
    'image'                => ':attribute deve ser uma imagem.',
    'in'                   => ':attribute é inválido.',
    'in_array'             => ':attribute campo não existe em :other.',
    'integer'              => ':attribute deve ser um número inteiro.',
    'ip'                   => ':attribute deve ser um endereço IP válido.',
    'json'                 => ':attribute deve ser um JSON válido.',
    'max'                  => [
        'numeric' => ':attribute não deve ser maior que :max.',
        'file'    => ':attribute não deve ter mais que :max kilobytes.',
        'string'  => ':attribute não deve ter mais que :max caracteres.',
        'array'   => ':attribute não pode ter mais que :max itens.',
    ],
    'mimes'                => ':attribute deve ser um arquivo do tipo: :values.',
    'mimetypes'            => ':attribute deve ser um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => ':attribute deve ser no mínimo :min.',
        'file'    => ':attribute deve ter no mínimo :min kilobytes.',
        'string'  => ':attribute deve ter no mínimo :min caracteres.',
        'array'   => ':attribute deve ter no mínimo :min itens.',
    ],
    'not_in'               => 'O :attribute selecionado é inválido.',
    'numeric'              => ':attribute deve ser um número.',
    'present'              => 'O :attribute deve estar presente.',
    'regex'                => 'O formato de :attribute é inválido.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_unless'      => 'O :attribute é necessário a menos que :other esteja em :values.',
    'required_with'        => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all'    => 'O campo :attribute é obrigatório quando :values estão presentes.',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum destes estão presentes: :values.',
    'same'                 => ':attribute e :other devem ser iguais.',
    'size'                 => [
        'numeric' => ':attribute deve ser :size.',
        'file'    => ':attribute deve ter :size kilobytes.',
        'string'  => ':attribute deve ter :size caracteres.',
        'array'   => ':attribute deve conter :size itens.',
    ],
    'string'               => ':attribute deve ser uma string',
    'timezone'             => ':attribute deve ser uma timezone válida.',
    'unique'               => ':attribute já está em uso.',
    'uploaded'             => ':attribute falhou no upload.',
    'url'                  => 'O formato de :attribute é inválido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'escutar_evento' => [
            'not_in' => 'O campo :attribute é obrigatório'
        ],
        'email_assunto' => [
            'required_with' => 'O campo :attribute é obrigatório quando Envio de Email estiver ativo'
        ],
        'email_corpo' => [
            'required_with' => 'O campo :attribute é obrigatório quando Envio de Email estiver ativo'
        ],
         'email_corpo' => [
            'required_with' => 'O campo :attribute é obrigatório quando Envio de Email estiver ativo'
        ],
        "cadeado_pin" => [
            "required_if" => 'O campo :attribute é obrigatório quando Cadeado Pessoal estiver ativo'
        ],
        "num_siga_me" => [
            "required_if" => 'O campo :attribute é obrigatório quando Siga me estiver ativo'
        ],
        "cx_postal_pw" => [
            "required_if" => 'O campo :attribute é obrigatório quando Caixa Postal estivar ativa'
        ],
        "atend_automatico_tipo" => [
            "required_if" => 'O campo :attribute é obrigatório quando Atendimento automáticao estiver ativo'
        ],
        "atend_automatico_destino" => [
            "required_if" => 'O campo :attribute é obrigatório quando Atendimento automáticao estiver ativo'
        ],
         "usuario_did" => [
            "required_if" => 'O campo :attribute é obrigatório quando DID estiver ativo'
        ],
         "senha_did" => [
            "required_if" => 'O campo :attribute é obrigatório quando DID estiver ativo'
        ],
         "ip_did" => [
            "required_if" => 'O campo :attribute é obrigatório quando DID estiver ativo'
        ],
         "extensao_did" => [
             "required_if" => 'O campo :attribute é obrigatório quando DID estiver ativo'
        ],


    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        "arquivo_audio" => "Arquivo de Áudio",
        "atend_automatico" => "Atendimento Automático",
        "atend_automatico_tipo" => "Tipo do Atendimento Automático",
        "atend_automatico_destino" => "Destino do Atendimento Automático",
        "cx_postal_pw" => "Senha da caixa postal",
        "cx_postal_email" => "Email da caixa postal",
        "saudacoes_destino" => "Saudacoes Destino",
        "num_siga_me" => "Número do Siga-me",
        "cadeado pin" => "Pin do cadeado",
        "password"=>"Senha",
        "email"=>"Email",
        "password_confirm"=>"Confirmação de senha",
        "name"=>"Nome",
        //formulario de notificações
        "mensagem"=>"Mensagem",
        "titulo"=>"Título",
        "nome"=>"Nome",
        "nivel"=>"Nível",
        "escutar_evento"=>"Evento",
        "ativar_email"=>"Ativar Email",
        "email_assunto"=>"Assundo do Email",
        "intervalo_reenvio"=>"Intervalo de reenvio",
        "numero_envios"=>"Número de envios",
        "email_corpo"=>"Corpo do email",
        //**************************
        //formulário de linhas
        "assinante" => "Assinante",
        "ddd_local" => "DDD Local",
        "simultaneas" => "Simultâneas",
        "rota_cli" => "Rota CLI",
        "plano" => "Plano",
        "login_ata" => "Login ATA",
        "usuario" => "Usuário",
        "senha" => "Senha",
        "ip" => "IP",
        "porta" => "Porta",
        "status_did" => "Status do DID",
        "usuario_did" => "Usuário do DID",
        "senha_did" => "Senha do DID",
        "ip_did" => "IP do DID",
        "extensao_did" => "Extensão do DID",
        "codecs" => "Codecs",
        "rotas_saida" => "Rotas de Saíra",
        "callerid" => "Callerid",
        "call_group" => "Call Group",
        "pickup_group" => "Pickup Group",
        "envio_dtmf" => "Envio de DTMF",
        "ring_falso" => "Ring falso",
        "nat" => "NAT",
        "gravacao" => "Gravação",
        "cadeado_pessoal" => "Cadeado pessoal",
        "siga_me" => "Siga-me",
        "caixa_postal" => "Caixa Postal",
        "cadeado_pin" => "PIN do Cadeado",
        "pode_monitorar" => "Pode Monitorar",
        "monitoravel" => "Monitoravel",
        "num_siga_me" => "Número do Siga me",
        "cx_postal_pw" => "Senha da Caixa Postal",
        "cx_postal_email" => "Email da Caixa Postal",
        "ligacao_fixo" => "Ligação para fixo",
        "ligacao_internacional" => "Ligação internacional",
        "ligacao_movel" => "Ligação para móvel",
        "ligacao_ip" => "Ligação para Ip",
        "status" => "Status",
        //*************
        /** formulário de assinantes **/
        "tipo" => "Tipo",
        "cpf" => "CPF",
        "nome_fantasia" => "Nome Fantasia",
        "razao_social" => "Razão Social",
        "cnpj" => "CNPJ",
        "inscricao_estadual" => "Inscrição Estadual",
        "sobrenome" => "Sobrenome",
        "cep" => "CEP",
        "endereco" => "Endereço",
        "complemento" => "Complemento",
        "bairro" => "Bairro",
        "cidade" => "Cidade",
        "estado" => "Estado",
        "pais" => "País",
        "site" => "Site",
        "telefone" => "Telefone",
        "fax" => "FAX",
        "celular" => "Celular",
        "gravacoes" => "Gravações",
        "correio_voz" => "Correio de voz",
        "grupos_atendimento" => "Grupos de atendimento",
        "fila" => "Fila",
        "saudacoes" => "Saudações",
        "ura" => "URA",
        "acesso_extrato" => "Acesso ao Extrato",
        "dias_bloqueio" => "Dias de Bloqueio",
        "dia_vencimento" => "Dia de Vencimento",
        "alerta_saldo" => "Alerta de Saldo",
        "espaco_disco" => "Espaço em disco",
        "nome_acesso" => "Nome de Acesso",
        "email_acesso" => "Email de Acesso",
        "senha_acesso" => "Senha de Acesso",
        /*Formulário Grupo de Atendimento do Cliente*/
        "tempo_chamada" => "Tempo de chamada"

    ]

];
