<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class UsercontrollerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateUser(): void
    {
        $parametre = [
            'name' => 'name',
            'email' => 'email@example.com',
            'password' => 'password'
        ];

        $users = User::all();
        $this->assertCount(0, $users);

        $response = $this->postJson('/api/create', $parametre);

        $users = User::all();
        $this->assertCount(1, $users);

        $createdUser = $users->first();
        $this->assertSame($parametre['name'], $createdUser->name);
        $this->assertSame($parametre['email'], $createdUser->email);
    }
    public function testShowAllUsers(): void
    {
        $users = User::factory()->count(3)->create();

        $response = $this->getJson('/api/users');

        $response->assertStatus(200);

        foreach ($users as $user) {
            $response->assertSee($user->name);
            $response->assertSee($user->email);

        }
    }
    public function testUpdateUsers(): void
    {
        $users = User::factory()->count(3)->create();
        $userToUpdate = $users->first();
        $updateData = [
            'name' => 'Updated Name',
            'email' => 'updated_email@example.com',
            'password' => 'newpassword'
        ];
        $response = $this->postJson("/api/update/{$userToUpdate->id}", $updateData);
        $response->assertStatus(200);

        $updatedUser = User::find($userToUpdate->id);
        $this->assertEquals('Updated Name', $updatedUser->name);
        $this->assertEquals('updated_email@example.com', $updatedUser->email);



    }
    public function testDeleteUser(): void
    {
        $users = User::factory()->count(3)->create();

        $userToDelete = $users->first();

        $response = $this->getJson("/api/delete/{$userToDelete->id}");

        $response->assertStatus(200);

        $deletedUser = User::find($userToDelete->id);
        $this->assertNull($deletedUser, ' user have been deleted');
    }


}
