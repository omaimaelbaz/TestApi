<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    //  use RefreshDatabase;
    protected function refreshTable($table)
    {
        DB::table($table)->truncate();
    }
    public function test_user_can_be_created(): void
    {
        $this->refreshTable('users');

        $response = $this->postJson('/api/create', [

            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(201);
        $this->assertCount(1, User::all());
    }
}
