<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;

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
 * @property int $is_public
 * @property int|null $user_id
 * @property int|null $team_id
 * @property-read \App\Models\Team|null $team
 * @property-read \App\Models\User|null $user
 * @method static Builder|Program visibles()
 * @method static Builder|Program whereIsPublic($value)
 * @method static Builder|Program whereTeamId($value)
 * @method static Builder|Program whereUserId($value)
 */
class Program extends Model
{
    use HasFactory;

    /**
     * @var string[]
     *
     * @psalm-var array{0: string, 1: string, 2: string}
     */
    protected $fillable = [
        'name',
        'is_public',
        'team_id',
    ];

    /**
     * @return HasMany
     *
     * @psalm-return HasMany<Clause>
     */
    public function clauses(): HasMany
    {
        return $this->hasMany(Clause::class);
    }

    /**
     * @return HasMany
     *
     * @psalm-return HasMany<PrologFile>
     */
    public function prolog_files(): HasMany
    {
        return $this->hasMany(PrologFile::class);
    }

    /**
     * @return HasMany
     *
     * @psalm-return HasMany<PrologQuery>
     */
    public function prolog_queries(): HasMany
    {
        return $this->hasMany(PrologQuery::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @psalm-return \Illuminate\Database\Eloquent\Relations\BelongsTo<User>
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @psalm-return \Illuminate\Database\Eloquent\Relations\BelongsTo<Team>
     */
    public function team(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * @psalm-suppress UndefinedDocblockClass
     * @param Builder $query
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function scopeVisibles(Builder $query)
    {
        if (Auth::check()) {
            $user = User::find(Auth::id());

            return $query->where('is_public', true)
            ->when(Auth::check(), function (Builder $query) use ($user) {
                $query->orWhere('user_id', $user->id)
                    ->orWhere(function (Builder $query) use ($user) {
                        $teams = $user->allTeams()->pluck('id')->toArray();
                        $query->whereIn('team_id', $teams);
                    });
            });
        }

        return $query->where('is_public', true);
    }
}
