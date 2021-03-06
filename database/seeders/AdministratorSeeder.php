<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new \App\Models\User;
      $user->username = "admin";
      $user->name = "Admin";
      $user->email = "admin@gmail.com";
      $user->password = \Hash::make("admin");
      $user->level ="admin";
      $user->save();
      $this->command->info("User Admin berhasil dibuat");
    }

}
