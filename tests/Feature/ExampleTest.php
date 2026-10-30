<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_interest_registration_page_shows_the_required_fields(): void
    {
        $response = $this->get('/');

        $response
            ->assertSee('Laufey')
            ->assertSee('Register your interest')
            ->assertSee('id="full-name" name="fullName" type="text"', false)
            ->assertSee('id="email" name="email" type="email"', false)
            ->assertSee('value="Regular"', false)
            ->assertSee('value="VIP"', false)
            ->assertSee('value="Meet &amp; Greet"', false)
            ->assertSee('min="1" max="6"', false)
            ->assertSee('This is a fan-made registration page, not an official ticketing site.');
    }
}
