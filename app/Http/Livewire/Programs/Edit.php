<?php

namespace App\Http\Livewire\Programs;

use App\Models\Program;
use Livewire\Component;

class Edit extends Component
{
    /**
     *
     * @var Program
     */
    public $program;

    protected $listeners = [
        'prologFileDeleted' => 'getPrologFilesProperty',
        'prologQueryDeleted' => 'getPrologQueriesProperty',
    ];

    protected $rules = [
        'program.name' => 'required|string|min:4',
    ];

    public function save()
    {
        $this->authorize('update', $this->program);

        $this->validate();

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

    public function render()
    {
        return view('livewire.programs.edit');
    }
}
