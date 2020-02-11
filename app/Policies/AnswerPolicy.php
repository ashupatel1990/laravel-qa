<?php

namespace App\Policies;

use App\Answers;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;


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
     * Determine whether the user can accept the answers as best answer.
     *
     * @param  \App\User  $user
     * @param  \App\Answers  $answers
     * @return mixed
     */
    public function accept(User $user, Answers $answers)
    {
        return $user->id === $answers->questions->user_id;
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
