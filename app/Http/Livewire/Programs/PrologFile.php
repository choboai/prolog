<?php

namespace App\Http\Livewire\Programs;

use App\Models\PrologFile as PrologFileModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PrologFile extends Component
{
    use AuthorizesRequests;

    /**
     * @var PrologFileModel
     */
    public $prologFile;

    protected $rules = [
        'prologFile.name' => 'required|string|min:3',
        'prologFile.content' => 'nullable|string',
    ];

    public function save()
    {
        $this->authorize('update', $this->prologFile->program);

        $this->validate();

        $this->prologFile->save();
        $this->emitUp('contentSaved');
    }

    public function deletePrologFile()
    {
        $this->authorize('update', $this->prologFile->program);

        $this->prologFile->delete();
        $this->emitUp('prologFileDeleted');
    }

    public function render()
    {
        return view('livewire.programs.prolog-file');
    }
}
