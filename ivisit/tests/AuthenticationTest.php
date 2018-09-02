<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function registered_user_receives_a_token_after_logging_in()
    {
        $this->disableExceptionHandling();

        factory(\App\User::class)->create([
            'email' => 'iapple@javra.com',
            'password' => sha1('pass@pfconcept'),
        ]);
        $this->post('/login', ['email' => 'iapple@javra.com', 'password' => 'pass@pfconcept'])
            ->seeJsonStructure(['token'])
            ->seeStatusCode(200);
    }

    /**
     * @test
     */

    public function guests_cannot_receive_a_token()
    {
        $this->json('POST', '/login', ['email' => 'nonexisting@gmail.com', 'password' => 'hello123'])
            ->seeJsonContains(['message' => 'user_not_found'])
            ->seeStatusCode(404);
    }

    /**
     * @test
     */

    public function user_must_post_email()
    {
        $this->post('/login', ['email' => null, 'password' => 'password1234'])
            ->seeJsonStructure(['errors'])
            ->seeStatusCode(422);
    }

    /**
     * @test
     */

    public function user_must_post_a_valid_email()
    {
        $this->post('/login', ['email' => 'thisisaninvalidemail', 'password' => 'password1234'])
            ->seeJsonStructure(['errors'])
            ->seeStatusCode(422);
    }

    /**
     * @test
     */

    public function user_must_post_password()
    {
        $this->post('/login', ['email' => 'test@email.com', 'password' => null])
            ->seeJsonStructure(['errors'])
            ->seeStatusCode(422);
    }
}
