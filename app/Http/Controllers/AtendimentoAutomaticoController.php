<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AtendimentoAutomaticoController extends Controller
{
    
    public function index(){
    	return view("rvc.atendimento_automatico.index", ['active'=>'atend_automatico']);
    }

    public function create(){
    	return view("rvc.atendimento_automatico.create", ['active'=>'atend_automatico']);
    }

    public function store(AtendAutomaticoRequest $request){

    }
}
