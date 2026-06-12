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
        // Keep the default smoke test independent from app-specific DB state.
        $response = $this->get('/up');

        $response->assertStatus(200);
    }
}
