<?php

namespace App\Http\Livewire\Programs;

use App\Models\PrologFile;
use App\Models\PrologQuery;
use Livewire\Component;

class Show extends Component
{
    /**
     *
     * @var Program
     */
    public $program;

    public function getPrologFilesProperty()
    {
        return $this->program->prolog_files()->get();
    }

    public function getPrologQueriesProperty()
    {
        return $this->program->prolog_queries()->get();
    }

    public function duplicateProgram()
    {
        $clone = $this->program->replicate();
        $clone->user_id = request()->user()->id ?? null;
        $clone->team_id = null;
        $clone->save();

        $this->program->prolog_files->each(function (PrologFile $file) use ($clone) {
            $clone->prolog_files()->create($file->toArray());
        });

        $this->program->prolog_queries->each(function (PrologQuery $query) use ($clone) {
            $clone->prolog_queries()->create($query->toArray());
        });

        session()->flash('ok', 'Program successfully cloned.');

        return redirect()->route('programs.edit', $clone);
    }

    public function render()
    {
        return view('livewire.programs.show');
    }
}
