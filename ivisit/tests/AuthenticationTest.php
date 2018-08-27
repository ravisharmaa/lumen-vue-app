<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function registered_user_receives_a_token_after_logging_in()
    {
        $this->disableExceptionHandling();

        factory(\App\User::class)->create([
            'email' => 'iapple@javra.com',
            'password' => sha1('pass@pfconcept')
        ]);
        $this->post('/login', ['email' => 'iapple@javra.com', 'password' => 'pass@pfconcept'])
            ->seeJsonStructure(['token'])
            ->seeStatusCode(200);
    }

    /** @test */
    public function guests_cannot_receive_a_token()
    {
        $this->json('POST', '/login', ['email' => 'nonexisting@gmail.com', 'password' => 'hello123'])
            ->seeJsonContains(['message' => 'user_not_found'])
            ->seeStatusCode(401);
    }

    /** @test */
    public function registered_users_must_post_their_details()
    {
        $this->post('/login')
            ->seeJsonStructure(['email', 'password'])
            ->seeStatusCode(422);
    }
}
