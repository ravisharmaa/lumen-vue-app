<?php

use App\Heading;
use App\Survey;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Lumen\Testing\DatabaseMigrations;

class HeadingTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_heading_has_surveys()
    {
        $heading = factory(Heading::class)->create();
        factory(Survey::class)->create([
            'headingid' => $heading->id,
        ]);

        $this->assertInstanceOf(Collection::class, $heading->surveys);

        $this->assertTrue($heading->surveys->contains('headingid', $heading->id));
    }

    /**
     * @test
     */
    public function can_add_surveys()
    {
        $headings = factory(Heading::class)->create();

        $survey = factory(Survey::class)->state('without_heading')->make();

        $headings->addSurvey($survey->toArray());

        $newSurvey = Survey::all();

        $this->assertCount(1, $newSurvey->heading);
    }
}
