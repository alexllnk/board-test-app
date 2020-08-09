<?php

namespace Tests\Unit;

use App\Project;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_has_a_path()
    {
        $task = factory(Task::class)->create();
        $this->assertEquals($task->path(), $task->project->path() . '/tasks/' . $task->id);
    }

    /**
     * @test
     */
    public function it_can_be_deleted(){
        $user = $this->signIn();
        $project = factory(Project::class)->create(['owner_id' => auth()->id()]);
        $task = $project->addTask([
            'body' => 'test task'
        ]);
        $this->assertDatabaseHas('tasks', ['body' => 'test task']);

        $this->delete($task->path());
        $this->assertEquals(0, $project->tasks->count());
        $this->assertDatabaseMissing('tasks', ['body' => 'test task']);
    }
}
