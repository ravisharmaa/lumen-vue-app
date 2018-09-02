<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Tymon\JWTAuth\Facades\JWTAuth;

class CreateAppUsersTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(App\User::class)->create();
    }

    /**
     * @test
     */
    public function guest_cannot_create_app_users()
    {
        $this->disableExceptionHandling();

        $this->json('POST', '/app-users/store')
            ->seeJsonEquals(['message' => 'Unauthorized.'])
            ->assertResponseStatus(401);
    }

    /**
     * @test
     */
    public function authorised_user_can_create_app_users()
    {
        $this->disableExceptionHandling()->actingAs($this->user);
        $appUser = factory(App\AppUsers::class)->make(['UserName' => 'creation@gmail.com']);

        $this->post(
            '/app-users/store',
            $appUser->toArray(),
            ['HTTP_Authorization' => 'Bearer '.JWTAuth::fromUser($this->user)]
        );
        $this->seeInDatabase('AppUsers', ['UserName' => 'creation@gmail.com']);
    }

    /**
     * @test
     */
    public function authenticated_user_must_post_required_attributes()
    {
        $this->actingAs($this->user);

        $this->post(
            '/app-users/store',
            [],
            ['HTTP_Authorization' => 'Bearer '.JWTAuth::fromUser($this->user)]
        )->seeJsonStructure(['errors'])->assertResponseStatus(422);
    }

    /**
     * @test
     */
    public function authenticated_user_must_match_password_attributes()
    {
        $this->disableExceptionHandling()->actingAs($this->user);

        $appUser = factory(App\AppUsers::class)->make([
            'UserName' => 'test@gmail.com',
            'Password' => sha1('password'),
            'Password_confirmation' => sha1('password'),
        ]);

        $this->post(
            'app-users/store',
            $appUser->toArray(),
            ['HTTP_Authorization' => 'Bearer '.JWTAuth::fromUser($this->user)]
        );

        $this->seeInDatabase('AppUsers', ['UserName' => 'test@gmail.com']);
    }
}
