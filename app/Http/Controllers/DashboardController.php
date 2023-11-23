<?php

namespace App\Http\Controllers;

use App\Models\Question;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $questions = Question::all();
        return view('dashboard', ['questions' => $questions]);
    }
}
