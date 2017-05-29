<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\AsteriskFileParser;

class AsteriskConfigFileParserProvider extends ServiceProvider
{   
    protected $defer = true;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("App\Helpers\Contracts\AsteriskConfigFileParserContract", function(){
            return new AsteriskFileParser();
        });
    }

    public function provides(){
        return [AsteriskFileParser::class];
    }
}
