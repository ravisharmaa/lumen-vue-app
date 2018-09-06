<?php


use App\Http\Requests\ValidationRequest;

class ValidatorTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->validator = Mockery::mock('validation');
    }
    /**
     * @test
     */

    /**
     * @test
     * @expectedException \App\Exceptions\ValidationFailedException
     */

    public function that_an_exception_is_thrown_if_validation_fails()
    {
        $request = new Illuminate\Http\Request();
        $this->validator->shouldReceive('validate')->with($request);
    }


}
