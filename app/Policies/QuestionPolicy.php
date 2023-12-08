<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;

class QuestionPolicy
{
    public function publish(User $user, Question $question): bool
    {
        return $question->user->is($user);
    }

    public function destroy(User $user, Question $question): bool
    {
        return $question->user->is($user);
    }
}
