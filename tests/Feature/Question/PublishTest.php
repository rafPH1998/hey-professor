<?php

use App\Models\User;
use App\Models\Question;
use function Pest\Laravel\{actingAs, assertDatabaseHas, put};

test('should be able to publish a question', function () {
    $user = User::factory()->create();
    actingAs($user);
    $question = Question::factory()->create([
        'draft' => true,
        'user_id' => $user->id
    ]);

    put(route('question.publish', $question))->assertRedirect();

    $question->refresh();

    expect($question)->draft->toBeFalse();

});

test('should make sure that only the person who has created the question can publish the question', function () {
    $rightuser = User::factory()->create();
    $wronguser = User::factory()->create();
    $question = Question::factory()->create(['draft' => true, 'user_id' => $rightuser->id]);

    actingAs($wronguser);
    put(route('question.publish', $question))->assertForbidden();

    actingAs($rightuser);
    put(route('question.publish', $question))->assertRedirect();
});

