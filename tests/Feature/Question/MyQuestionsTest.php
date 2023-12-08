<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

test('should list all my questions', function () {
    $wrongUser = User::factory()->create();
    $wrongQuestions = Question::factory()->for($wrongUser)->count(10)->create();

    $user = User::factory()->create();
    $questions = Question::factory()->for($user)->count(10)->create();

    actingAs($user);

    $response = get(route('question.index'));

    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }

    foreach ($wrongQuestions as $q) {
        $response->assertDontSee($q->question);
    }
});
