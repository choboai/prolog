<?php

namespace App\Http\Livewire\Programs;

use App\Models\PrologFile as PrologFileModel;
use Livewire\Component;

class PrologFile extends Component
{
    /**
     * @var PrologFileModel
     */
    public $prologFile;

    protected $rules = [
        'prologFile.name' => 'required|string|min:6',
        'prologFile.content' => 'nullable|string',
    ];

    public function save()
    {
        $this->validate();

        $this->prologFile->save();
    }

    public function deletePrologFile()
    {
        $this->prologFile->delete();
        $this->emitUp('prologFileDeleted');
    }

    public function render()
    {
        return view('livewire.programs.prolog-file');
    }
}
