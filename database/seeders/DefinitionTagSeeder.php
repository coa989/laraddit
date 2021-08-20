<?php

namespace Database\Seeders;

use App\Models\Definition;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DefinitionTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all the tags attaching up to 3 random tags to each user
        $tags = Tag::all();

        // Populate the pivot table
        Definition::all()->each(function ($definition) use ($tags) {
            $definition->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
