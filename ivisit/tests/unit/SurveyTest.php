<?php

use App\Survey;
use Laravel\Lumen\Testing\DatabaseMigrations;

class SurveyTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->survey = factory(Survey::class)->create();
    }

    /**
     * @test
     */
    public function a_survey_has_heading()
    {
        $this->assertInstanceOf(\App\Heading::class, $this->survey->heading);
    }
}
