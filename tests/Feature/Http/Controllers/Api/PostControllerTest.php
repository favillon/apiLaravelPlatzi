<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

    public function testPostShow()
    {
        $post = factory(Post::class)->create();

        $response = $this->json(
            'GET', 
            "/api/posts/$post->id",
        );

        $response->assertJsonStructure(['id', 'title', 'created_at', 'updated_at'])
            ->assertJson(['title'=> $post->title])
            ->assertStatus(200);        
    }

    public function testPostShowNotExist()
    {
        $post = factory(Post::class)->create();
        $idNotExist = 1000;
        $response = $this->json(
            'GET', 
            "/api/posts/$idNotExist",
        );

        $response->assertStatus(404);        
    }

    public function testPostUpdate()
    {
        $post = factory(Post::class)->create();
        $response = $this->json(
            'PUT', 
            "/api/posts/$post->id",
            [
                'title' => 'Actualizacion post'
            ]
        );

        $response->assertJsonStructure(['id', 'title', 'created_at', 'updated_at'])
            ->assertJson(['title'=> 'Actualizacion post'])
            ->assertStatus(200);
        $this->assertDatabaseHas('posts', ['title'=>'Actualizacion post']);        
    }

    public function testPostDelete()
    {
        $post = factory(Post::class)->create();
        $response = $this->json(
            'DELETE', 
            "/api/posts/$post->id"
        );

        $response->assertSee(null)
            ->assertStatus(204);

        $this->assertDatabaseMissing('posts', ['id'=>$post->id]);        
    }

    public function testPostView()
    {
        $post = factory(Post::class, 5)->create();
        $response = $this->json(
            'GET', 
            "/api/posts/"
        );

        $response->assertJsonStructure(
            [
                'data' => [
                    '*' => ['id', 'title', 'created_at', 'updated_at']
                ]
            ]
        )->assertStatus(200);        
    }
}
