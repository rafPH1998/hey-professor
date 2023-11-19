<?php

use App\Models\User;
use Pest\Plugins\Only;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;
use function PHPUnit\Framework\once;

test('should be able to create a new question bigger than 255 characters', function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat('*', 260) . '?']);
});


test('should check if ends with question mark ?', function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260)
    ]);

    $request->assertSessionHas('error', 'Você não identificou o ?. Por tanto o texto precisa ser uma pergunta.');
    assertDatabaseCount('questions', 0);

});

/*
test('should have at least 10 characters', function () {
    expect(true)->toBeTrue();
});
 */
