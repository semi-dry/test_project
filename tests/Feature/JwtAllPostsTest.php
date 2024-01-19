<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class JwtAllPostsTest extends TestCase
{

    public function testGetAllPosts()
    {

        $data = $this->token();
        $token = $data['token'];
        $user_id = $data['user_id'];
        $headers = ['Authorization' => "Bearer $token"];

        $post = Post::factory(['title' => 'Some Title', 'content' => 'Some content', 'user_id' => $user_id])->create();

        $this->json('GET', 'api/posts', $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                "status",
                "posts" =>
                [
                  [  "id",
                    "user_id",
                    "title",
                    "content",
                    "created_at",
                    "updated_at",
                ]
                    ]
            ]);


    }

    public function testCreatePost()
    {

        $data = $this->token();
        $token = $data['token'];
        $user_id = $data['user_id'];
        $headers = ['Authorization' => "Bearer $token"];

        $post = ['title' => 'Some Title', 'content' => 'Some content', 'user_id' => $user_id];

        $this->json('POST', 'api/posts',$post, $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                "status",
                "post" =>
                        [  "id",
                            "user_id",
                            "title",
                            "content",
                            "created_at",
                            "updated_at",
                        ]
            ]);


    }

    public function testUpdatePost()
    {

        $data = $this->token();
        $token = $data['token'];
        $user_id = $data['user_id'];
        $headers = ['Authorization' => "Bearer $token"];

        $post = Post::factory(['title' => 'Some Title', 'content' => 'Some content', 'user_id' => $user_id])->create();

        $changes = ['title'=>'Changed Post'];

        $this->json('PATCH', "api/posts/{$post->id}", $changes, $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                "status",
                "post" =>
                    [  "id",
                        "user_id",
                        "title",
                        "content",
                        "created_at",
                        "updated_at",
                    ]
            ]);


    }


    public function testDeletePost()
    {

        $data = $this->token();
        $token = $data['token'];
        $user_id = $data['user_id'];
        $headers = ['Authorization' => "Bearer $token"];

        $post = Post::factory(['title' => 'Some Title', 'content' => 'Some content', 'user_id' => $user_id])->create();

        $this->json('DELETE', "api/posts/{$post->id}", [], $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                "status",
                "message",
                "post" =>
                    [
                        "id",
                        "user_id",
                        "title",
                        "content",
                        "created_at",
                        "updated_at",
                    ]
            ]);


    }
}
