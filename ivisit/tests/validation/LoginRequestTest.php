<?php

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginRequestTest extends TestCase
{
    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }

    /**
     * @test
     * @expectedException \App\Exceptions\ValidationFailedException
     */
    public function that_an_exception_is_thrown_if_validation_fails()
    {
        $request = Mockery::mock(Request::class);

        $request->shouldReceive('all')
            ->andReturn([]);

        $validator = Mockery::mock(\Illuminate\Validation\Validator::class);

        $validator->shouldReceive('fails')
            ->andReturn(true);

        Validator::shouldReceive('make')
            ->with($request->all(), [
                'email' => 'required | email',
                'password' => 'required',
            ])->andReturn($validator);

        $loginRequest = new LoginRequest();

        $loginRequest->validate($request);
    }
}
