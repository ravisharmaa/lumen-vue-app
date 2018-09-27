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

    /** @test */
    public function guest_cannot_create_surveys()
    {
        $this->disableExceptionHandling();

        $this->json('POST', 'surveys')
            ->seeJsonEquals(['message' => 'Unauthorized.'])
            ->assertResponseStatus(401);
    }

   
}
