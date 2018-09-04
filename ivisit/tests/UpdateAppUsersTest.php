<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class UpdateAppUsersTest extends TestCase
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
    public function guests_can_not_update_app_users()
    {
        $this->disableExceptionHandling();
        $this->json('PUT', 'app-users/1/update')
            ->seeJsonEquals(['message' => 'Unauthorized.'])
            ->assertResponseStatus(401);
    }

    /**
     * @test
     */
    public function authorised_user_can_update_app_users()
    {
        $this->disableExceptionHandling()->actingAs($this->user);

        factory(App\AppUsers::class)->create([
            'UserName' => 'existing@test.com',
        ]);
        $update = factory(App\AppUsers::class)->make([
            'UserName' => 'update@test.com',
        ]);

        $this->postAsAuthenticated('put','app-users/1/update', $update->toArray(), $this->user);

        $this->notSeeInDatabase('AppUsers', ['UserName' => 'existing@test.com']);

        $this->seeInDatabase('AppUsers', ['UserName' => 'update@test.com'])
            ->seeJsonEquals(['message'=>'Resource Updated'])
            ->assertResponseStatus(200);
    }

    /**
     * @test
     */
    public function authorised_user_can_not_update_un_existing_app_users()
    {
        $this->actingAs($this->user);

        $update = factory(App\AppUsers::class)->make();

        $this->postAsAuthenticated('put','app-users/1/update', $update->toArray(), $this->user)
            ->seeJsonEquals(['message' => 'User Not found'])
            ->assertResponseStatus(404);
    }

    /**
     * @test
     */
    public function authorised_user_must_post_required_attributes()
    {
        $this->disableExceptionHandling()->actingAs($this->user);

        factory(App\AppUsers::class)->create();

        $this->postAsAuthenticated('put','app-users/1/update',[], $this->user)
            ->seeJsonEquals(['message' => 'Resource Updated'])
            ->assertResponseStatus(200);

    }




}
