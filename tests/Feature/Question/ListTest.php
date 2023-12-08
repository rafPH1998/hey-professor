<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

test('should list all the question', function () {
    $user = User::factory()->create();
    $question = Question::factory()->count(5)->create();

    actingAs($user);

    $response = get(route('dashboard'));

    foreach ($question as $q) {
        $response->assertSee($q->question);
    }
});
