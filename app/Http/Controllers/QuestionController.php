<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionController extends Controller
{
    public function store() : RedirectResponse
    {
        if (!strpos(request()->question, '?')) {
            return back()->with('error', 'Você não identificou o ?. Por tanto o texto precisa ser uma pergunta.');
        }

        Question::query()->create(['question' => request()->question]);
        return to_route('dashboard');
    }
}
