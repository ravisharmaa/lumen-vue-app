<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class EditAppUsersTest extends TestCase
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
    public function guests_can_not_edit_app_users()
    {
        $this->disableExceptionHandling()
            ->json('GET', 'app-users/1/edit')
            ->seeJsonEquals(['message' => 'Unauthorized.'])
            ->assertResponseStatus(401);
    }

    /**
     * @test
     */
    public function authorised_user_can_edit_app_users()
    {
        factory(App\AppUsers::class)->create();

        $this->disableExceptionHandling()->actingAs($this->user);

        $this->getAsAuthenticated('app-users/1/edit', $this->user)
            ->seeJsonStructure(['app_user'])
            ->assertResponseStatus(200);
    }

    /**
     * @test
     */
    public function authorised_user_can_not_edit_un_existing_app_users()
    {
        $this->actingAs($this->user);

        $this->getAsAuthenticated('app-users/334/edit', $this->user)
            ->seeJsonEquals(['message' => 'User Not found'])
            ->assertResponseStatus(404);
    }
}
