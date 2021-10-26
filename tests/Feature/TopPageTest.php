<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TopPageTest extends TestCase
{
    /**
     * @test
     */
     
    public function topページへのアクセスの可否()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
                         ->get('/');

        $response->assertStatus(200);
    }
}
