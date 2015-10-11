<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $user = factory(App\User::class)->create([
            'name' => 'p',
            'email' => $faker->email(),
            'password' => bcrypt('test')
        ]);


        //$node = factory(App\Node::class)->create();
        //factory(App\Node::class, 100)->create();

        //$nodestatus = factory(App\Nodestat::class, 50)->create(['node_id' => $node->id]);

        $task = factory(App\Task::class)->create(['user_id' => $user->id, 'node_id' => \App\Node::all()->random(1)->id]);
        $task = factory(App\Task::class)->create(['user_id' => $user->id, 'node_id' => \App\Node::all()->random(1)->id]);
        $task = factory(App\Task::class)->create(['user_id' => $user->id, 'node_id' => \App\Node::all()->random(1)->id]);

        Model::reguard();
    }
}
