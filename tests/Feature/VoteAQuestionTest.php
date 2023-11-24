<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

test('should be able to store a like in the question', function () {
    $user = User::factory()->create();
    $question = Question::factory()->create();

    actingAs($user);

    $user->like($question);
    assertDatabaseCount('votes', 1);

    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'like' => 1,
        'unlike' => 0,
        'user_id' => $user->id
    ]);

    $user->like($question);
    assertDatabaseCount('votes', 0);

});

