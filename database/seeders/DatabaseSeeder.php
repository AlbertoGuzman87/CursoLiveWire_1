<?php

namespace Database\Seeders;

use Illuminate\Contracts\Cache\Store;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('imgPost');
        Storage::makeDirectory('imgPost');

        $this->call(UserSeeder::class);

        \App\Models\Post::factory(100)->create();
    }
}
