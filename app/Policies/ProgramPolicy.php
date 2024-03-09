<?php

namespace App\Policies;

use App\Models\Program;
use App\Models\User;
use App\Models\programs;
use Illuminate\Auth\Access\Response;

class ProgramPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->id;
    }

    public function view(User $user, Program $program): bool
    {
        return $user->program()->where('program_id',$program)->first() || $user->QA === 1;
    }

    public function create(User $user): bool
    {
        return $user->QA === 1;
    }

    public function update(User $user, Program $program): bool
    {
        return $user->program()->where('program_id',$program)->first() || $user->QA === 1;
    }
    public function delete(User $user): bool
    {
        return $user->QA === 1;
    }

}
