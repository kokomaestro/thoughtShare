<?php

namespace App\Models\Traits;

use App\Models\Like;
use Illuminate\Database\Eloquent\Builder;

trait Likable
{
  public function scopeWithLikes(Builder $query) {
    // select * from thoughts
    // left join(
    // 	select sum(liked) likes, sum(!liked) dislikes from likes group by thought_id
    // ) likes on likes.thought_id = thoughts.id
    $query->leftJoinSub(
      'select thought_id, sum(liked) likes, sum(!liked) dislikes from likes group by thought_id',
      'likes',
      'likes.thought_id',
      'thoughts.id'
    );
  }

  public function likes() {
    $this->hasMany(Like::class)->latest()->get();
  }

  public function like($user = null, $liked = true) {
    Like::updateOrCreate([
      'thought_id' => $this->id,
      'user_id' => $user ? $user->id : auth()->id(),
    ],
    [
      'liked' => $liked,
    ]);
  }

  public function dislike($user = null) {
    $this->like($user, false);
  }

  public function isLikedBy(User $user, $liked = true) {
    return (bool) $user->likes
      ->where('thought_id', $this->id)
      ->where('liked', $liked)
      ->count();
  }

  public function isDislikedBy(User $user, $liked = true) {
    return $this->isLikedBy($user, false);
  }
}
