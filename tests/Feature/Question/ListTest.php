<?php

use App\Models\Question;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

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

test('should paginate the result', function () {
    $user = User::factory()->create();
   Question::factory()->count(20)->create();

    actingAs($user);

    get(route('dashboard'))
        ->assertViewHas('questions', fn($value) => $value instanceof LengthAwarePaginator && $value->count() == 10);
});

test('should order by like and unlike, most liked question should be at the top, most unliked questions should be in the bottom', function () {

    $user = User::factory()->create();
    $secondUser = User::factory()->create();
    Question::factory()->count(5)->create();

    $firstLikedQuestion = Question::find(3);
    $firstUnlikedQuestion = Question::find(1);

    $user->like($firstLikedQuestion);
    $user->unlike($firstUnlikedQuestion);

    actingAs($user);

    get(route('dashboard'))
        ->assertViewHas('questions', function ($questions) use ($firstLikedQuestion, $firstUnlikedQuestion) {

            expect($questions)
                ->first()->id->toBe(3)
                ->and($questions)
                ->last()->id->toBe(1);

            return true;

        });
});


