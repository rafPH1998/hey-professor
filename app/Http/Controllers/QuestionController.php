<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Closure;
use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{
    public function store() : RedirectResponse
    {
        request()->validate([
            'question' => [
                'required',
                'min:10',
                function (string $attr, mixed $value, Closure $fail) {
                    if ($value[strlen($value) - 1] != '?') {
                        $fail('Você não identificou o ?. Por tanto o texto precisa ser uma pergunta.');
                    }
                }
            ],
        ]);

        $user = auth()->user();
        $user->questions()->create([
            'question' => request()->question,
            'draft'    => true
        ]);

        return redirect('dashboard')->with('success', 'Question created with success!!');
    }
}
