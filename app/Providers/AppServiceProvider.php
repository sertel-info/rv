<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Dusk\DuskServiceProvider;
use Illuminate\Support\Facades\Validator;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Muda o defaultStringLength para parar de dar erro nas migrations*/
        Schema::defaultStringLength(191);

        /* Cria o modo de validação para ip e porta combinados serem únicos*/
        Validator::extend('unique_combined', function ($attribute, $value, $parameters, $validator) {
            if(count($parameters) == 3){
                list($data ,$table, $field) = $parameters;

                return DB::table($table)->where([[$attribute,'=', $value],
                                                 [$field, '=', $validator->getData()[$data]]])
                                    ->first() == null;

            } else  if (count($parameters) == 4) {
                list($data ,$table, $field, $id_ignore) = $parameters;

                return DB::table($table)->where([[$attribute,'=', $value],
                                             [$field, '=', $validator->getData()[$data]],
                                             [DB::raw('id'), '<>', $id_ignore]])
                                    ->first() == null;
            }
         
            });

        Validator::replacer('unique_combined', function ($message, $attribute, $rule, $parameters) {
            list($data ,$table, $field) = $parameters;
            $message = str_replace(':attribute', $attribute, $message);
            $message = str_replace(':other', $data, $message);

            return $message;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if($this->app->environment('local', 'testing')){
          $this->app->register(DuskServiceProvider::class);
        }
    }
}
