<?php
use Laravel\Lumen\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function authenticated_user_has_a_valid_token()
    {
        $user = factory(App\User::class)->create([
            'email'=>'iapple@javra.com',
            'password'=>sha1('pass@pfconcept')
        ]);
        $this->actingAs($user);
        $this->assertNotEmpty($user->getToken());
    }


}
