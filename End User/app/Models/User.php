<?php

namespace App\Models;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'image',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getImageURL(){
        if($this->image){
            return url('storage/'.$this->image);

        }
        return asset('profile/defaultProfile.jpg');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function userScores() {
        return $this->hasMany(UserScore::class);
    }

    public function userAnswers() {
        return $this->hasMany(UserAnswer::class);
    }

    public function suggestions() {
        return $this->hasMany(Suggestion::class);
    }

}
