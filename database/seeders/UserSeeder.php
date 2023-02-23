<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $check = User::where('phone',998998955991)->first();
        if (empty($check)){
            $user = new User();
            $user->role_id = 1;
            $user->name = "Admin";
            $user->email = "admin@gx.uz";
            $user->phone = 998998955991;
            $user->password = bcrypt(123456);
            $user->save();
        }
    }
}
