<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

        Question::query()->create(['question' => request()->question]);

        return redirect('dashboard')->with('success', 'Question created with success!!');
    }
}
