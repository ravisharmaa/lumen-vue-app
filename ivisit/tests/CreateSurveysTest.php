<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class CreateSurveysTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(App\User::class)->create();
    }

    /**
     * @test
     * */
    public function guest_cannot_create_surveys()
    {
        $this->disableExceptionHandling();

        $this->json('POST', 'surveys')
            ->seeJsonEquals(['message' => 'Unauthorized.'])
            ->assertResponseStatus(401);
    }

    /**
     * @test
     */
    public function authorised_user_can_create_surveys()
    {
        $this->disableExceptionHandling()->actingAs($this->user);

        $heading = factory(\App\Heading::class)->create()->toArray();
        $survey = factory(\App\Survey::class)->state('without_heading')->make()->toArray();


    }
}
