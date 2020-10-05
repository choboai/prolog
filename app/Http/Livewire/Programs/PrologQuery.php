<?php

namespace App\Http\Livewire\Programs;

use App\Models\PrologQuery as PrologQueryModel;
use Livewire\Component;

class PrologQuery extends Component
{
    /**
     * @var PrologQueryModel
     */
    public $prologQuery;

    protected $rules = [
        'prologQuery.name' => 'required|string|min:6',
        'prologQuery.content' => 'nullable|string',
    ];

    public function save()
    {
        $this->validate();

        $this->prologQuery->save();
    }

    public function deletePrologQuery()
    {
        $this->prologQuery->delete();
        $this->emitUp('prologQueryDeleted');
    }

    public function render()
    {
        // dd($this->prologQuery);

        return view('livewire.programs.prolog-query');
    }
}
