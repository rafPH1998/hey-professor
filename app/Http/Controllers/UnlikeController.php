<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\RedirectResponse;

class UnlikeController extends Controller
{
    public function __invoke(Question $question): RedirectResponse
    {
        /*
        * @var User $user;
        */
        $user = auth()->user();
        $user->unlike($question);
        return back();
    }
}
