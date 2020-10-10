<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\User;
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

    public function create(): \Illuminate\Http\RedirectResponse
    {
        if (Auth::check()) {
            $program = User::find(Auth::id())->programs()->create();
        } else {
            $program = Program::create();
        }

        return redirect()->route('programs.edit', $program->id);
    }

    public function edit(Program $program): View
    {
        $this->authorize('update', $program);

        return view(
            'programs.edit',
            [
                'program' => $program,
            ]
        );
    }
}
