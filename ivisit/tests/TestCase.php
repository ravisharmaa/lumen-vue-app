<?php
use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;

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
        app()->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct(){}
            public function report(\Exception $e) {}
            public function render($request, \Exception $e){
                throw $e;
            }
        });
    }
}
