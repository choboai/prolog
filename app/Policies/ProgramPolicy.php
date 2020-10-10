<?php

namespace App\Policies;

use App\Models\Program;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProgramPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given program can be updated by the user.
     *
     * @param  \App\Models\User  $user|null
     * @param  \App\Models\Program  $program
     * @return bool
     */
    public function update(?User $user, Program $program)
    {
        // anon creator
        if ($program->user === null) {
            return true;
        }

        // anon user
        if ($user === null) {
            return false;
        }

        if ($program->team_id !== null && $user->teams()->find($program->team_id) !== null) {
            return true;
        }

        return $user->id === $program->user_id;
    }

    /**
     * Determine if the given program can be deleted by the user.
     *
     * @param  \App\Models\User  $user|null
     * @param  \App\Models\Program  $program
     * @return bool
     */
    public function delete(?User $user, Program $program)
    {
        // anon creator
        if ($program->user === null) {
            return true;
        }

        return $user->id === $program->user_id;
    }
}
