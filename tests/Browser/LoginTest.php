<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use App\User;
use App\Models\Dish;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();
        $this->seed('DatabaseSeeder');
        $this->seed('TestDataSeeder');
    }

    /**
     * Logging in with a valid client user should complete successfully and
     * redirect to the client page.
     * 
     * @return void
     */
    public function testClientLogin()
    {
        $user = User::where('email', 'client@example.com')->first();

        $this->browse(function ($browser) use ($user) {
            $browser
                ->maximize()
                ->visit('http://localhost:8000/login')
                ->waitForText('Login')
                ->type('#email', $user->email)
                ->type('#password', 'password')
                ->click('.login-form button')
                ->assertPathIs('/comensal')
                ->waitForText("Bienvenido, {$user->name}")
                ->assertSee("Bienvenido, {$user->name}");
        });
    }

    /**
     * Logging out from the client's session.
     *
     * @return void
     */
    public function testClientLogout()
    {
        $this->browse(function ($browser) {
            $browser
                ->click('#logout-button')
                ->assertPathIs('/login')
                ->waitForText('Login')
                ->assertSee('Login');
        });
    }

    /**
     * Logging in with a valid admin user should complete successfully and
     * redirect to the admin panel.
     * 
     * @return void
     */
    public function testAdminLogin()
    {
        $user = User::where('email', 'admin@hive.online')->first();

        $this
            ->browse(function ($browser) use ($user) {
                $browser
                    ->visit('http://localhost:8000/login')
                    ->waitForText('Login')
                    ->type('#email', $user->email)
                    ->type('#password', 'weallfit2017')
                    ->click('.login-form button')
                    ->waitForText('MENU')
                    ->assertSee('MENU');
            });
    }

    /**
     * Logging out from the admin's session.
     *
     * @return void
     */
    public function testAdminLogout()
    {
        $this->browse(function ($browser) {
            $browser
                ->click('#profile-toggle')
                ->waitForText('Cerrar Sessión')
                ->click('#logout-button')
                ->assertPathIs('/login')
                ->waitForText('Login')
                ->assertSee('Login');
        });
    }

    /**
     * Dishes should be visible on page.
     * 
     * @return void
     */
    public function testAdminAddsDishesToMenu()
    {
        $user = User::where('email', 'admin@hive.online')->first();

        $this->browse(function ($browser) use ($user) {
            $browser
                ->loginAs($user)
                ->visit('http://localhost:8000/admin/platillos')
                ->waitForText('PLATILLOS');
            
            $browser->assertSee('Quesadilla');
            $browser->assertSee('Pollo');
            $browser->assertSee('Ensalada');
        });
    }
}
