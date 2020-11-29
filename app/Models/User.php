<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;
use App\Models\Traits\Followable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function thoughtList() {
      $friends = $this->follows()->pluck('id');

      return Thought::whereIn('user_id', $friends)
        ->withLikes()
        ->orWhere('user_id', $this->id)
        ->latest();
    }

    public function getAvatarAttribute($value) {
      return asset($value ?: '/images/default-avatar.jpeg');
    }

    public function thoughts() {
      return $this->hasMany(Thought::class)->withLikes()->latest();
    }

    public function getUsers() {
      $users = User::paginate(10)->toArray()['data'];
      return $users;
    }

    public function getAccountLinks() {
      return $this->thoughts()->paginate(50)->toArray()['links'];
    }

    public function getDashboardLinks() {
      return $this->thoughtList()->paginate(50)->toArray()['links'];
    }

    public function likes() {
      return $this->hasMany(Like::class);
    }

    public function likeList() {

      return $this->likes()->where('user_id', $this->id)
        ->latest()->get();
    }

}
