<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * A basic test example.
     *
     * @test
     */
    public function a_user_can_create_a_project()
    {
        $attributes = [
            'stts' => $this->faker->name,
            'slba' => $this->faker->phoneNumber
        ];

        $this->post('/slbs', $attributes);
        $this->assertDatabaseHas('slbs', $attributes);
        $response->assertStatus(200);
    }
}
