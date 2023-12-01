<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class PublishController extends Controller
{
    public function __invoke(Question $question)
    {
        $question->update(['draft' => false]);

        return back();
    }
}
