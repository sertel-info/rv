<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AssinantesFormTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

     //use WithoutMiddleware;

    public function testExample()
    {
        $user = \App\User::find(1);


        $this->actingAs($user)
        	 ->get("/")
        	 ->assertStatus(200);
    }
}
