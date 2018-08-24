<?php
use Laravel\Lumen\Testing\DatabaseMigrations;

class ViewAppUsersTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(App\User::class)->create([
            'email'=>'iapple@javra.com',
            'password' => sha1('pass@pfconcept')
       ]);
    }

    /** @test*/
    public function guest_cannot_view_app_users()
    {
        $this->disableExceptionHandling();
        $this->json('GET', '/app-users')
            ->seeJsonEquals(['message'=>'Unauthorized.'])
            ->assertResponseStatus(401);
    }

    /** @test */
    public function authenticated_users_must_provide_a_valid_token()
    {
        $this->actingAs($this->user)->json('GET', '/app-users', ['HTTP_Authorization'=>''])
            ->seeJsonEquals(['message'=>'token_not_found']);
    }

    /**
     * @test
     */
    public function authorized_user_can_view_app_users()
    {
        $this->disableExceptionHandling();
        $this->actingAs($this->user);
        $this->get('/app-users', ['HTTP_Authorization'=>"Bearer ".$this->user->getToken()])
            ->seeJsonEquals(['app_users']);
    }
}
