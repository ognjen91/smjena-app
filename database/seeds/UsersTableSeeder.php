<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = factory(User::class)->create([
          'name' => 'Ognjen',
          'email' => config('app.ognjens_mail'),
          'password' => bcrypt(config('app.ognjens_password'))
        ]);
        $user2 = factory(User::class)->create([
          'name' => 'Ivana',
          'email' => config('app.ivanas_mail'),
          'password' => bcrypt(config('app.ivanas_password'))
        ]);
    }
}
