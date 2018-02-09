<?php

use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
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

        Collection::times(7, function ($number) {
            factory(Group::class)->create();
        });
    }
}
