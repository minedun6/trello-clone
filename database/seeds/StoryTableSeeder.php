<?php

use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use App\Models\Story;
use Illuminate\Support\Facades\DB;

class StoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stories')->truncate();

        Collection::times(50, function ($number) {
            factory(Story::class)->create(['group_id' => Group::inRandomOrder()->first()->id]);
        });
    }
}
