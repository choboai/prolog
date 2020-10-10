<?php

namespace App\Http\Livewire\Programs;

use App\Models\PrologQuery as PrologQueryModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PrologQuery extends Component
{
    use AuthorizesRequests;

    /**
     * @var PrologQueryModel
     */
    public $prologQuery;

    protected $rules = [
        'prologQuery.name' => 'required|string|min:3',
        'prologQuery.content' => 'nullable|string',
    ];

    public function save()
    {
        $this->authorize('update', $this->prologFile->program);

        $this->validate();

        $this->prologQuery->save();
        $this->emitUp('contentSaved');
    }

    public function deletePrologQuery()
    {
        $this->authorize('update', $this->prologFile->program);

        $this->prologQuery->delete();
        $this->emitUp('prologQueryDeleted');
    }

    public function render()
    {
        // dd($this->prologQuery);

        return view('livewire.programs.prolog-query');
    }
}
