<?php

namespace App\Policies;

use App\Answers;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the answers.
     *
     * @param  \App\User  $user
     * @param  \App\Answers  $answers
     * @return mixed
     */
    public function view(User $user, Answers $answers)
    {
        //
    }

    /**
     * Determine whether the user can create answers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the answers.
     *
     * @param  \App\User  $user
     * @param  \App\Answers  $answers
     * @return mixed
     */
    public function update(User $user, Answers $answers)
    {
        return $user->id === $answers->user_id;
    }

    /**
     * Determine whether the user can delete the answers.
     *
     * @param  \App\User  $user
     * @param  \App\Answers  $answers
     * @return mixed
     */
    public function delete(User $user, Answers $answers)
    {
        return $user->id === $answers->user_id;
    }

}
