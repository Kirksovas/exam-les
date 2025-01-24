<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Thing;

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Thing;

class ThingSeeder extends Seeder
{
    public function run()
    {
        Thing::factory()->count(10)->create();
    }
}
