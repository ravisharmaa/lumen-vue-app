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
        $appUser = factory(App\AppUsers::class)->make(['UserName'=>'creation@gmail.com']);

        $this->post(
            '/app-users/store',
             $appUser->toArray(),
            ['HTTP_Authorization' => 'Bearer '.JWTAuth::fromUser($this->user)]
        );
        $this->seeInDatabase('AppUsers', ['UserName'=>'creation@gmail.com']);
    }

   



}
