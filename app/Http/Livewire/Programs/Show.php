<?php

namespace App\Http\Livewire\Programs;

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

    public function render()
    {
        return view('livewire.programs.show');
    }
}
