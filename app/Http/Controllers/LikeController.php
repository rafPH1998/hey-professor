<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Vote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __invoke(Question $question): RedirectResponse
    {
        /**
        * @var User $user
        */
        $user = auth()->user();
        $user->like($question);
        return back();
    }
}
