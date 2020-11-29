<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Like extends Model
{

  protected $fillable = [
      'user_id',
      'thought_id',
      'liked',
  ];

    public $incrementing = false;

}
