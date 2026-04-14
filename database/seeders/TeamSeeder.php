<?php

namespace Database\Seeders;

use App\Models\Team;
use App\TeamColor;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (TeamColor::cases() as $color) {
            Team::create([
                'color' => $color->value,
                'name' => $color->label(),
                'score' => 0,
            ]);
        }
    }
}
