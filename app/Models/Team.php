<?php

namespace App\Models;

use App\TeamColor;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['color', 'name', 'score'];

    public function casts(): array
    {
        return [
            'color' => TeamColor::class,
            'score' => 'integer',
        ];
    }
}
