<?php

namespace Tests\Feature;

use App\Models\PrologFile;
use App\Models\PrologQuery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBaseUrl()
    {
        $response = $this->get('/');

        $response->assertRedirect(route('programs.index'));
    }

    public function testProgramsIndex()
    {
        $programs = \App\Models\Program::factory(10)
            ->has(PrologFile::factory()->count(1), 'prolog_files')
            ->has(PrologQuery::factory()->count(1), 'prolog_queries')
            ->create();

        $response = $this->get(route('programs.index'));
        foreach ($programs->pluck('name')->toArray() as $program) {
            $response->assertSee($program);
        }
    }
}
