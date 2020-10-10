<?php

namespace Database\Seeders;

use App\Models\PrologFile;
use App\Models\PrologQuery;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Program::factory(30)
            ->has(PrologFile::factory()->count(1), 'prolog_files')
            ->has(PrologQuery::factory()->count(1), 'prolog_queries')
            ->create();
    }
}
