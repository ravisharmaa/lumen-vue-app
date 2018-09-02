<?php

use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Tymon\JWTAuth\Facades\JWTAuth;

abstract class TestCase extends Laravel\Lumen\Testing\TestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    public function disableExceptionHandling()
    {
        app()->instance(ExceptionHandler::class, new class() extends Handler {
            public function __construct()
            {
            }

            public function report(\Exception $e)
            {
            }

            public function render($request, \Exception $e)
            {
                throw $e;
            }
        });

        return $this;
    }

    public function getAsAuthenticated($uri,$user)
    {
        $this->get($uri, ['HTTP_Authorization'=>'Bearer '.JWTAuth::fromUser($user)]);

        return $this;
    }
}
