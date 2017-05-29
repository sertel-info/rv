<?php
//namespace Database\factories\Assinantes;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Linhas\Linhas::class, function (Faker\Generator $faker) {

    return [  
    	"assinante_id"=>rand(1,10),
    	"simultaneas"=>rand(1,10),
        "tecnologia"=>'sip',
        "nome"=>'linha '.$faker->username(),
        "ddd_local"=>$faker->randomNumber(2),
        "cli"=>rand(0,1),
        "status_did"=>rand(0,1),
        "funcionalidade"=>$faker->randomElement(["linha_ip",
														"portal_voz",
														"callingguard"]),
        "codecs"=>$faker->randomElements(["h264",
                                            "g729",
                                            "ulaw",
                                            "alaw",
                                            "g726",
                                            "g723",
                                            "gsm",
                                            "speex",
                                            "slin",
                                            "h261",
                                            "h263",
                                            "h263p",
                                            "ilbc",
                                            "g722"], rand(0, 10))
    ];
});
