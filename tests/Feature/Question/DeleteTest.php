<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\delete;

test('should delete only my questions', function () {
    $rightuser = User::factory()->create();
    $wronguser = User::factory()->create();
    $question = Question::factory()->create(['draft' => true, 'user_id' => $rightuser->id]);

    actingAs($wronguser);
    delete(route('question.destroy', $question))->assertForbidden();

    actingAs($rightuser);
    delete(route('question.destroy', $question))->assertRedirect();

    assertDatabaseMissing('questions', ['id' => $question->id]);
});
