<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */


    protected function setUp(): void
    {
        parent::setUp();

        // Create a user and authenticate
        $user = User::factory()->create();
        Sanctum::actingAs($user);
    }


    public function test_index_returns_successful_response()
    {
        Category::factory(3)->create();

        $response = $this->getJson('/api/categories');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }


    public function test_store_creates_new_category()
    {
        $response = $this->postJson('/api/categories', [
            'name' => 'New Category',
            'description' => 'Category description',

        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'New Category']);
    }


    public function test_store_fails_with_invalid_data()
    {
        $response = $this->postJson('/api/categories', [
            'name' => '', // Invalid name
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('name');
    }



    public function test_show_returns_category()
    {
        $category = Category::factory()->create();

        $response = $this->getJson("/api/categories/$category->id");

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => $category->name]);
    }




    public function test_show_fails_for_nonexistent_category()
    {
        $response = $this->getJson('/api/categories/9999');

        $response->assertStatus(404);
    }



    public function test_update_modifies_existing_category()
    {
        $category = Category::factory()->create();

        $response = $this->putJson("/api/categories/{$category->id}", [
            'name' => 'Updated Category',
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Category']);
    }



    public function test_update_fails_with_invalid_data()
    {
        $category = Category::factory()->create();

        $response = $this->putJson("/api/categories/{$category->id}", [
            'name' => '', // Invalid name
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('name');
    }



    public function test_destroy_removes_category()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson("/api/categories/{$category->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }






    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Laravel');
    }

    public  function  testFetchingOneProduct()
    {
//        $response = $this->get('/api/products/1');
//        dd($response);
        $product = Product::factory()->create();
        $this->assertEquals(1, $product->id);
    }




}
