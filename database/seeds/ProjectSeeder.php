<?php

use App\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testUser = User::find(1);
        $testUser->projects()->createMany(
            factory(App\Project::class, 6)->make(['owner_id' => 1])->toArray()
        );
    }
}
