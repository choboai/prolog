<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\View\View;

class ProgramController extends Controller
{
    public function index(): View
    {
        return view('programs.index');
    }

    public function create()
    {
        $program = Program::create();

        return redirect()->route('programs.edit', $program->id);
    }

    public function edit(Program $program): View
    {
        return view(
            'programs.edit',
            [
                'program' => $program,
            ]
        );
    }
}
