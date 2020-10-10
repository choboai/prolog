<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Program
 *
 * @mixin IdeHelperProgram
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Clause[] $clauses
 * @property-read int|null $clauses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PrologFile[] $prolog_files
 * @property-read int|null $prolog_files_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PrologQuery[] $prolog_queries
 * @property-read int|null $prolog_queries_count
 * @method static \Illuminate\Database\Eloquent\Builder|Program newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Program newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Program query()
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereUpdatedAt($value)
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereName($value)
 */
class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_public',
        'team_id',
    ];

    public function clauses(): HasMany
    {
        return $this->hasMany(Clause::class);
    }

    public function prolog_files(): HasMany
    {
        return $this->hasMany(PrologFile::class);
    }

    public function prolog_queries(): HasMany
    {
        return $this->hasMany(PrologQuery::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function scopeVisibles(Builder $query)
    {
        return $query->where('is_public', true)
            ->when(Auth::check(), function (Builder $query) {
                $query->orWhere('user_id', Auth::user()->id)
                    ->orWhere(function (Builder $query) {
                        $query->whereIn('team_id', Auth::user()->allTeams()->pluck('id')->toArray());
                    });
            });
    }
}
