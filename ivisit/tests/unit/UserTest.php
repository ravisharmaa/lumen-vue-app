<?php
use Laravel\Lumen\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function authenticated_user_has_a_token()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        $this->assertNotEmpty($user->getToken());
    }
}
