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
            'email' => 'test@user.com',
            'password' => '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8',
        ]);
        $this->post('/login', ['email' => 'test@user.com', 'password' => 'password'])
            ->seeJsonStructure(['token'])
            ->seeStatusCode(200);
    }

    /**
     * @test
     */
    public function guests_cannot_receive_a_token()
    {
        $this->json('POST', '/login', ['email' => 'nonexisting@gmail.com', 'password' => 'hello123'])
            ->seeJsonContains(['message' => 'Sorry try again'])
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
