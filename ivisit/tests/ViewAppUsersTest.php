<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class ViewAppUsersTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(App\User::class)->create();
    }

    /** @test */
    public function guest_cannot_view_app_users()
    {
        $this->disableExceptionHandling();

        $this->json('GET', '/app-users')
            ->seeJsonEquals(['message' => 'Unauthorized.'])
            ->assertResponseStatus(401);
    }

    /** @test */
    public function authenticated_users_must_provide_a_valid_token()
    {
        $this->actingAs($this->user)->json('GET', '/app-users', ['HTTP_Authorization' => ''])
            ->seeJsonEquals(['message' => 'token_not_found'])
            ->assertResponseStatus(404);
    }

    /**
     * @test
     */
    public function authorized_user_can_browse_app_users()
    {
        $this->disableExceptionHandling();

        factory(App\AppUsers::class,3)->create();

        $this->actingAs($this->user);

        $data = json_decode($this->get(
            '/app-users',
            ['HTTP_Authorization' => 'Bearer '.JWTAuth::fromUser($this->user)]
        )->response->getContent(), true);

        $this->assertNotEmpty($data['app_users']);
    }

    /**
     * @test
     */
    public function authorised_user_can_filter_app_users_by_status()
    {
        $this->disableExceptionHandling()->actingAs($this->user);

        factory(App\AppUsers::class, 3)->state('active')->create();

        factory(App\AppUsers::class, 3)->state('inactive')->create();

        $activeUsers = json_decode($this->getAsAuthenticated('app-users?active=1', $this->user)
                    ->response->getContent(),true);

    }
}
