<?php

use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->truncate();

        factory(Group::class)->create(['name' => 'Todo', 'color_class' => 'red']);
        factory(Group::class)->create(['name' => 'Done', 'color_class' => 'green']);
        factory(Group::class)->create(['name' => 'Doing', 'color_class' => 'blue']);
        factory(Group::class)->create(['name' => 'Custom Group', 'color_class' => 'purple']);
        factory(Group::class)->create(['name' => 'Custom Group2', 'color_class' => 'yellow']);
    }
}
