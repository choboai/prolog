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

    protected $rules = [
        'program.name' => 'required|string|min:6',
    ];

    public function save()
    {
        $this->validate();

        $this->program->save();
    }

    public function createPrologFile()
    {
        $this->program->prolog_files()->create();
        $this->program->refresh();
    }

    public function render()
    {
        return view('livewire.programs.edit');
    }
}
