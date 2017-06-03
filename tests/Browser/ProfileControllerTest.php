<?php

namespace Tests\Browser;

use App\User;
use Faker\Factory;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class ProfileController
 * @package Tests\Browser
 */
class ProfileControllerTest extends DuskTestCase
{

    use DatabaseMigrations;

    /**
     * Test users are created ok on profile
     *
     * @return void
     */
    public function testUsersAreCreatedOkOnProfile()
    {
        //Prepare
        $faker = Factory::create();
        $user = [
            'name' => $name = $faker->name,
            'email' => $email = $faker->unique()->safeEmail,
            'password' => $password = $faker->password
        ];

        $admin = factory(User::class)->create();

        //Execute
        $this->browse(function (Browser $browser) use ($user, $admin) {
            $browser->loginAs($admin)
                    ->visit('/profile')
                    ->type('name', $user['name'])
                    ->type('email', $user['email'])
                    ->type('password', $user['password'])
                    ->attach('file', __DIR__.'/photos/profile.png')
                    ->press('Create')
                    //Asserts
                    ->assertSee('Laravel');
        });
    }
}
