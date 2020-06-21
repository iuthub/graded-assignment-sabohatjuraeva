<?php

use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = new Task([
            'user_id' => 1,
            'title'=>'some task'
        ]);
        $items->save();

        $items = new Task([
            'user_id' => 1,
            'title'=>'another task'
        ]);
        $items->save();

    }
}
