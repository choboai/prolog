<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Atom
 *
 * @mixin IdeHelperAtom
 * @property int $id
 * @property string $literal
 * @property int $predicate_id
 * @property int $predicates_list_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Atom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Atom newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Atom query()
 * @method static \Illuminate\Database\Eloquent\Builder|Atom whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Atom whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Atom whereLiteral($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Atom wherePredicateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Atom wherePredicatesListId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Atom whereUpdatedAt($value)
 */
class Atom extends Model
{
    use HasFactory;
}
