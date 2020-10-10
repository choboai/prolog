<?php

namespace App\Http\Livewire\Programs;

use App\Models\PrologQuery as PrologQueryModel;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Livewire\Component;
use Throwable;

class PrologQuery extends Component
{
    use AuthorizesRequests;

    /**
     * @psalm-suppress PropertyNotSetInConstructor
     * @var PrologQueryModel
     */
    public $prologQuery;

    /**
     * @psalm-suppress PropertyNotSetInConstructor
     * @var string[]
     */
    protected $rules = [
        'prologQuery.name' => 'required|string|min:3',
        'prologQuery.content' => 'nullable|string',
    ];

    /**
     * @return void
     * @throws AuthorizationException
     * @throws Throwable
     * @throws ValidationException
     * @throws InvalidArgumentException
     */
    public function save()
    {
        $this->authorize('update', $this->prologQuery->program);

        $this->validate();

        $this->prologQuery->save();
        $this->emitUp('contentSaved');
    }

    public function deletePrologQuery(): void
    {
        $this->authorize('update', $this->prologQuery->program);

        $this->prologQuery->delete();
        $this->emitUp('prologQueryDeleted');
    }

    public function render(): \Illuminate\View\View
    {
        // dd($this->prologQuery);

        return view('livewire.programs.prolog-query');
    }
}
