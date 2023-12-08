<?php

namespace App\Http\Controllers;

use App\Models\Question;

class PublishController extends Controller
{
    public function __invoke(Question $question)
    {
        $this->authorize('publish', $question);
        $question->update(['draft' => false]);

        return back();
    }
}
