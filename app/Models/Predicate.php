<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Predicate
 *
 * @mixin IdeHelperPredicate
 * @property int $id
 * @property int $clause_id
 * @property int $program_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Atom|null $atom
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Clause[] $atoms
 * @property-read int|null $atoms_count
 * @method static \Illuminate\Database\Eloquent\Builder|Predicate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Predicate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Predicate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Predicate whereClauseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Predicate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Predicate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Predicate whereProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Predicate whereUpdatedAt($value)
 * @method static \Database\Factories\PredicateFactory factory(...$parameters)
 */
class Predicate extends Model
{
    use HasFactory;

    /**
     * @var string[]
     *
     * @psalm-var array{0: string}
     */
    protected $fillable = [
        'literal',
    ];

    /**
     * @return HasOne
     *
     * @psalm-return HasOne<Atom>
     */
    public function atom(): HasOne
    {
        return $this->hasOne(Atom::class);
    }

    /**
     * @return HasMany
     *
     * @psalm-return HasMany<Clause>
     */
    public function atoms(): HasMany
    {
        return $this->hasMany(Clause::class, 'clauses_list_id', 'id');
    }
}
