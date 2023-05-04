<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'birthdate' => 'date',
    ];

    public function age(): Attribute
    {
        return Attribute::make(
            get: fn() => Carbon::parse($this->birthdate)->age,
        );
    }
}
