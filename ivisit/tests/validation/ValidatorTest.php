<?php


use App\Http\Requests\ValidationRequest;

class ValidatorTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->validator = Mockery::mock(ValidationRequest::class);
    }
    /**
     * @test
     */

    /*public function it_expects_request_object_on_construction()
    {

    }*/


}
