<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\CategoryController;
use App\Models\Categories;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */


     public function testebdpointShow(): void
     {
        
        $categories = Categories::all();
        $response = $this->getJson('/api/index');
        // dd($response);
        $response->assertJson($categories->toArray());
     }
}
