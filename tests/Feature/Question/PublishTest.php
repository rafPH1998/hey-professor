<?php

use App\Models\User;
use App\Models\Question;
use function Pest\Laravel\{actingAs, assertDatabaseHas, put};

test('should be able to publish a question', function () {
    $user = User::factory()->create();
    actingAs($user);
    $question = Question::factory()->create(['draft' => true]);

    put(route('question.publish', $question))->assertRedirect();

    $question->refresh();

    expect($question)->draft->toBeFalse();

});

