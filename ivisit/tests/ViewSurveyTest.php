<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class ViewSurveyTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(App\User::class)->create();
    }

    /** @test */
    public function guest_cannot_view_surveys()
    {
        $this->disableExceptionHandling();

        $this->json('GET', '/surveys')
            ->seeJsonEquals(['message' => 'Unauthorized.'])
            ->assertResponseStatus(401);
    }

    /** @test */
    public function authenticated_users_must_provide_a_valid_token()
    {
        $this->actingAs($this->user)->json('GET', '/surveys', ['HTTP_Authorization' => ''])
            ->seeJsonEquals(['message' => 'token_not_found'])
            ->assertResponseStatus(404);
    }

    /**
     * @test
     */
    public function authorized_user_can_browse_surveys()
    {
        $this->disableExceptionHandling()->actingAs($this->user);

        factory(App\Survey::class, 3)->create();

        $data = json_decode($this->getAsAuthenticated('/surveys', $this->user)
            ->response->getContent(), true);

        $this->assertNotEmpty($data['surveys']);
    }


}
