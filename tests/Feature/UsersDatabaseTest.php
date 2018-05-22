<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Role;
use App\Http\Controllers\UserController;

class UsersDatabaseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup test database before running tests.
     */
    public function setUp()
    {
        parent::setUp();

        Artisan::call('migrate:refresh');
        $this->seed('DatabaseSeeder');
        $this->seed('TestDataSeeder');
    }

    public function testCreatingUsers()
    {
        $expected = User::count() + 1;
        $controller = $this->app->make(UserController::class);
        $request = Request::create('/admin/users', 'POST', [
            'name' => 'Test user',
            'email' => 'test.user@example.com',
            'phone' => '1234567',
            'password' => 'password'
        ]);
        $response = $controller->store($request);
        
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals($expected, User::count());
        $this->assertDatabaseHas('users', [
            'email' => 'test.user@example.com'
        ]);
    }

    public function testDeletingUsers()
    {
        $user = User::first();
        $expected = User::count() - 1;

        $controller = $this->app->make(UserController::class);
        $response = $controller->destroy($user->id);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals($expected, User::count());
        $this->assertDatabaseMissing('users', [
            'email' => $user->email
        ]);
    }
}
