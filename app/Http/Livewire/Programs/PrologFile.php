<?php

namespace App\Http\Livewire\Programs;

use App\Models\PrologFile as PrologFileModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PrologFile extends Component
{
    use AuthorizesRequests;

    /**
     * @psalm-suppress PropertyNotSetInConstructor
     * @var PrologFileModel
     */
    public $prologFile;

    /**
     * @psalm-suppress PropertyNotSetInConstructor
     * @var string[]
     *
     * @psalm-var array{'prologFile.name': string, 'prologFile.content': string}
     */
    protected $rules = [
        'prologFile.name' => 'required|string|min:3',
        'prologFile.content' => 'nullable|string',
    ];

    public function save(): void
    {
        $this->authorize('update', $this->prologFile->program);

        $this->validate();

        $this->prologFile->save();
        $this->emitUp('contentSaved');
    }

    public function deletePrologFile(): void
    {
        $this->authorize('update', $this->prologFile->program);

        $this->prologFile->delete();
        $this->emitUp('prologFileDeleted');
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.programs.prolog-file');
    }
}
