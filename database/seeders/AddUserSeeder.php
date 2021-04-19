<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AddUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = new \App\Models\User;
        $user1->username = "egi";
        $user1->name = "Egi Rahmadani";
        $user1->email = "egi@gmail.com";
        $user1->password = \Hash::make("egi123");
        $user1->level = "staff";
        $user1->save();

        $user2 = new \App\Models\User;
        $user2->username = "sandi";
        $user2->name = "Sandi Cisco";
        $user2->email = "sandi@gmail.com";
        $user2->password = \Hash::make("sandi123");
        $user2->level = "staff";
        $user2->save();
        $this->command->info('User Seccesfuly');

        // $user2 = new \App\Models\User;
        // $user2->username = "sandi";
        // $user2->level = "staff";
        // $user2->name = "Sandi Cisco";
        // $user2->mobile = "085204333454";
        // $user2->email = "sandi@gmail.com";
        // $user2->password = \Hash::make("sandi123");
        // $user2->kd_district = 1;
        // $user2->status = 1;
        // $user2->save();
        // $this->command->info('User Seccesfuly');

    }
}
