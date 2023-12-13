<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertNotSoftDeleted;
use function Pest\Laravel\assertSoftDeleted;
use function Pest\Laravel\patch;

test('should be able archive a question', function () {
    $rightuser = User::factory()->create();
    $wronguser = User::factory()->create();
    $question = Question::factory()->create(['draft' => true, 'user_id' => $rightuser->id]);

    actingAs($wronguser);
    patch(route('question.destroy', $question))->assertForbidden();

    actingAs($rightuser);
    patch(route('question.archive', $question))->assertRedirect();

    assertSoftDeleted('questions', ['id' => $question->id]);

    expect($question)
        ->refresh()
        ->deleted_at->not->toBeNull();
});


test('should be able to restore an archived question', function () {
    $user = User::factory()->create();
    $question = Question::factory()->create([
        'draft' => true,
        'user_id' => $user->id,
        'deleted_at' => now()
    ]);

    actingAs($user);
    patch(route('question.restore', $question))->assertRedirect();

    assertNotSoftDeleted('questions', ['id' => $question->id]);

    expect($question)
        ->refresh()
        ->deleted_at->toBeNull();
});
