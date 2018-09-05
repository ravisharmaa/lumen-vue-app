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

        $user = factory(\App\User::class)->create();

        $this->post('/login', ['email' => $user->email, 'password' => 'password'])
            ->seeJsonStructure(['token'])
            ->seeStatusCode(200);
    }

    /**
     * @test
     */
    public function guests_cannot_receive_a_token()
    {
        $this->json('POST', '/login', ['email' => 'nonexisting@example.com', 'password' => 'hello123'])
            ->seeJsonContains(['message' => 'Sorry try again'])
            ->seeStatusCode(404);
    }

    /**
     * @test
     */
    public function user_must_post_email()
    {
        $this->post('/login', ['password' => 'password1234'])
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
        $this->post('/login', ['email' => 'test@example.com'])
            ->seeJsonStructure(['errors'])
            ->seeStatusCode(422);
    }
}
