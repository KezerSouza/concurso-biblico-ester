<?php

namespace App\Models;

use App\TeamColor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function pointHistories(): HasMany
    {
        return $this->hasMany(PointHistory::class);
    }
}
