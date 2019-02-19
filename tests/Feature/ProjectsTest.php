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
        $this->withoutExceptionHandling();

        $attributes = [
            'idbr' => $this->faker->phoneNumber,
            'date' => $this->faker->phoneNumber,
            'stts' => $this->faker->name,
            'slba' => $this->faker->phoneNumber
        ];

        $this->post('/welcome', $attributes)->assertRedirect('/welcome');
        $this->assertDatabaseHas('slbs', $attributes);
        $this->get('/welcome')->assertSee($attributes['stts']);
    }
}
