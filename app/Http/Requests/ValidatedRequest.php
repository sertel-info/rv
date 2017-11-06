<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ValidatedRequest extends FormRequest{

    public function response(Array $errors){
       return response()->json(["validation_errors"=>collect($errors)->flatten()], 400);
    }

}