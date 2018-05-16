<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Http\Controllers\OrderController;

class LoyaltyPointsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup test database before running tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->seed('DatabaseSeeder');
        $this->seed('TestDataSeeder');
    }

    /**
     * Test that the client's loyalty points are incremented when they
     * make an order.
     *
     * @return void
     */
    public function testOrderShouldIncreaseLoyaltyPoints()
    {
        // Get points before ordering.
        $user = User::find(3);
        $points = (int) $user->loyalty_points;
        
        // Set current user.
        // $this->be($user);

        $controller = $this->app->make(OrderController::class);

        $controller->incrementLoyaltyPoints($user);

        // Call method and assert that its return status.
        // $response = $this->call('POST', '/order', [
        //     'orderItems' => [
        //         ['dish_id' => 1, 'quantity' => 1]
        //     ]
        // ]);
        // $response->assertStatus(200);
        
        // Get points after ordering.        
        // $user = User::find(3);
        $newPoints = (int) $user->loyalty_points;

        // Assert that points were incremented by 1.
        $this->assertEquals($newPoints, $points + 1);
    }

    /**
     * Test that the endpoints fails when called without any order items.
     *
     * @return void
     */
    public function testOrderShouldFailOnEmptyOrder()
    {        
        // Set current user.
        $user = User::find(3);
        $this->be($user);

        // Call method and assert its return status.
        $response = $this->call('POST', '/order', [
            'orderItems' => []
        ]);
        $response->assertStatus(404);
    }

    /**
     * Test that a user with 7 or more points can redeem his points.
     * 
     * @return void
     */
    public function testUserCanRedeemHisPoints()
    {
        // Set current user as admin.
        $admin = User::all()->first(function ($user) {
            return $user->hasRole('admin');
        });
        $this->be($admin);

        // Set client's points.
        $client = User::getClients()->first();
        $client->loyalty_points = 7;
        $client->save();

        // Call method and assert its return status.
        $response = $this->call('GET', "/admin/loyalty/redeem/{$client->id}");
        $response->assertStatus(302);

        // Reload client data from database.
        $client->refresh();

        $this->assertEquals(0, $client->loyalty_points);
    }

    /**
     * Test that a user with less than 7 cannot redeem his points.
     * 
     * @return void
     */
    public function testUserCannotRedeemHisPoints()
    {
        // Set current user as admin.
        $admin = User::all()->first(function ($user) {
            return $user->hasRole('admin');
        });
        $this->be($admin);

        // Set client's points.
        $client = User::getClients()->first();
        $client->loyalty_points = 5;
        $client->save();

        // Call method and assert its return status.
        $response = $this->call('GET', "/admin/loyalty/redeem/{$client->id}");
        $response->assertStatus(400);
    }
}
