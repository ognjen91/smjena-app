<?php

use Illuminate\Database\Seeder;
use App\FreeDay;
use App\StartingDay;

class DaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(FreeDay::class, 120)->create();
        factory(StartingDay::class)->create();
    }
}
