<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thought;

class ThoughtLikesController extends Controller
{
    public function store(Thought $thought) {
      $thought->like(auth()->user());

      return back();
    }

    public function destroy(Thought $thought) {
      $thought->dislike(auth()->user());

      return back();
    }
 }
