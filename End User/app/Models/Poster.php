<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'year',
        'month',
        'level',
        'publish_date',
        'taken',
    ];


    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public static function getLevels() {
        return [
            'beginner',
            'intermediate',
            'upper intermediate',
            'advance',
        ];
    }

    public static function getMonths() {
        return [
            'january',
            'february',
            'march',
            'april',
            'may',
            'june',
            'july',
            'august',
            'september',
            'october',
            'november',
            'december',
        ];
    }




}

