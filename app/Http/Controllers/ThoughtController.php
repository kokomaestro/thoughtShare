<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thought;

class ThoughtController extends Controller
{
    public function store() {
        $attributes = request()->validate(['body' => 'required|max:255']);

        Thought::create([
          'user_id' => auth()->user()->id,
          'body' => $attributes['body']
        ]);

        return redirect('/dashboard');
    }
}
