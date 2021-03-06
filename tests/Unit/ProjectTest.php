<?php

namespace Tests\Unit;

use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class ProjectTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function it_has_an_owner()
    {
        $project = factory(Project::class)->create();
        $this->assertInstanceOf('App\User', $project->owner);
    }

    /**
     * @test
     */
    public function it_has_a_path(){
        $project = factory(Project::class)->create();
        $this->assertEquals($project->path(), '/projects/' . $project->id);
    }


}
