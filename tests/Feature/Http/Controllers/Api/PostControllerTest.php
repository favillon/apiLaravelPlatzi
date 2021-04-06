<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPostStore()
    {
        $this->withoutExceptionHandling();
        $response = $this->json(
            'POST', 
            '/api/posts',
            [
                'title' => 'El post de prueba'
            ]
        );

        $response->assertJsonStructure(['id', 'title', 'created_at', 'updated_at'])
            ->assertJson(['title'=>'El post de prueba' ])
            ->assertStatus(201);
        $this->assertDatabaseHas('posts', ['title'=>'El post de prueba']);
    }


    public function testPostValidateTitleStore()
    {
        //$this->withoutExceptionHandling();
        $response = $this->json(
            'POST', 
            '/api/posts',
            [
                'title' => ''
            ]
        );

        $response->assertStatus(422)
            ->assertJsonValidationErrors('title');
    }
}
