<?php

namespace Tests\Browser;

use App\User;
use Faker\Factory;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfileControllerTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * Test users are created ok on profile.
     *
     * @return void
     */
    public function test_users_are_created_ok_on_profile()
    {
        $faker = Factory::create();
        $user = [
            'name' => $name = $faker->name,
            'email' => $email = $faker->unique()->safeEmail,
            'password' => $password = $faker->password
        ];

        $admin = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user, $admin) {
            $browser->loginAs($admin)
                ->visit('profile')
                ->pause(5000)
                ->type('name',$user['name'])
                ->type('email',$user['email'])
                ->type('password',$user['password'])
                ->attach('file', __DIR__ . '/photos/guapo.png')
                    ->assertSee('Laravel');
        });
    }
}
