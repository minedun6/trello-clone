<?php

use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GroupTableSeeder extends Seeder
{

    protected $groupsName = ['Todo', 'Done', 'In progress', 'Custom group 1', 'Custom group 2'];

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
