<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('welcome');
    }

    public  function  testFetchingoneProduct()
    {
//        $response = $this->get('/api/products/1');
//        dd($response);
        $product = Product::factory()->create();
        $this->assertEquals(1, $product->id);
    }
}
