<?php

namespace App\Http\Controllers;

use App\Models\Question;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $questions = Question::withSum('votes', 'like')
                    ->withSum('votes', 'unlike')
                    ->paginate(10);

        return view('dashboard', ['questions' => $questions]);
    }
}
