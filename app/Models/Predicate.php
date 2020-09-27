<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Predicate extends Model
{
    use HasFactory;

    protected $fillable = [
        'literal',
    ];

    public function atom(): HasOne
    {
        return $this->hasOne(Atom::class);
    }

    public function atoms(): HasMany
    {
        return $this->hasMany(Clause::class, 'clauses_list_id', 'id');
    }
}
