<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

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
        $this->disableExceptionHandling()
            ->json('POST', '/app-users/store')
            ->seeJsonEquals(['message' => 'Unauthorized.'])
            ->assertResponseStatus(401);
    }

    /**
     * @test
     */
    public function authorised_user_can_create_app_users()
    {
        $this->disableExceptionHandling()->actingAs($this->user);

        $appUser = factory(App\AppUsers::class)->state('password_confirmation')
            ->make(['UserName' => 'creation@gmail.com']);

        $this->postAsAuthenticated('post','/app-users/store', $appUser->toArray(), $this->user);

        $this->seeInDatabase('AppUsers', ['UserName' => 'creation@gmail.com']);
    }

    /**
     * @test
     */
    public function authenticated_user_must_post_required_attributes()
    {
        $this->actingAs($this->user)
            ->postAsAuthenticated('post','/app-users/store', [], $this->user)
            ->seeJsonStructure(['errors'])->assertResponseStatus(422);
    }

    /**
     * @test
     */
    public function authenticated_user_must_match_password_attributes()
    {
        $this->actingAs($this->user);

        $appUser = factory(App\AppUsers::class)->make();

        $this->postAsAuthenticated('post','/app-users/store', $appUser->toArray(), $this->user)
             ->seeJsonStructure(['errors'])->assertResponseStatus(422);

        $appUser = factory(App\AppUsers::class)->state('password_confirmation')
            ->make(['UserName' => 'creation@gmail.com']);

        $this->postAsAuthenticated('post','/app-users/store', $appUser->toArray(), $this->user);

        $this->seeInDatabase('AppUsers', ['UserName' => 'creation@gmail.com']);
    }
}
