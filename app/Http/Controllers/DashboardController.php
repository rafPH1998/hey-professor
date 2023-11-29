<?php

namespace App\Http\Controllers;

use App\Models\Question;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $questions = Question::withSum('votes', 'like')
                    ->withSum('votes', 'unlike')
                    ->get();

        return view('dashboard', ['questions' => $questions]);
    }
}
