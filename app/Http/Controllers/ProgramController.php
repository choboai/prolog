<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProgramController extends Controller
{
    public function index(): View
    {
        return view('programs.index');
    }

    public function show(Program $program): View
    {
        return view(
            'programs.show',
            [
                'program' => $program,
            ]
        );
    }

    public function create()
    {
        if (Auth::check()) {
            $program = Auth::user()->programs()->create();
        } else {
            $program = Program::create();
        }

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
