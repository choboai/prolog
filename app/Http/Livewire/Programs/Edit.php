<?php

namespace App\Http\Livewire\Programs;

use App\Models\Program;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

    /**
     *
     * @var Program
     */
    public $program;

    protected $listeners = [
        'prologFileDeleted' => 'getPrologFilesProperty',
        'prologQueryDeleted' => 'getPrologQueriesProperty',
        'contentSaved' => 'getUpdatedAtProperty',
    ];

    protected $rules = [
        'program.name' => 'required|string|min:4',
        'program.is_public' => 'nullable|boolean',
        'program.team_id' => 'nullable|numeric',
    ];

    public function save()
    {
        $this->authorize('update', $this->program);

        $this->validate();
        if ($this->program->team_id == 0) {
            $this->program->team_id = null;
        }

        $this->program->save();
    }

    public function createPrologFile()
    {
        $this->program->prolog_files()->create();
        $this->getPrologFilesProperty();
    }

    public function createPrologQuery()
    {
        $this->program->prolog_queries()->create();
        $this->getPrologQueriesProperty();
    }

    public function getPrologFilesProperty()
    {
        return $this->program->prolog_files()->get();
    }

    public function getPrologQueriesProperty()
    {
        return $this->program->prolog_queries()->get();
    }

    public function getUpdatedAtProperty()
    {
        return $this->program->updated_at;
    }

    public function deleteProgram()
    {
        $this->authorize('delete', $this->program);

        $this->program->delete();

        session()->flash('ok', 'Program successfully deleted.');

        return redirect()->route('programs.index');
    }

    public function render()
    {
        return view('livewire.programs.edit');
    }
}
