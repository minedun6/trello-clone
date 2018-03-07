<?php

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    protected $groupsName = [
        'Todo',
        'Done',
        'In progress',
//        'Custom group 1',
//        'Custom group 2',
//        'Custom group 3',
//        'Custom-group-4'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->truncate();

        collect($this->groupsName)->each(function ($groupName) {
            factory(Group::class)->create(['name' => $groupName]);
        });
    }
}
