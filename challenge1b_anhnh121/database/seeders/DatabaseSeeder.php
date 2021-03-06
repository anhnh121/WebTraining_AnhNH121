<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(initSeeder::class);
    }
}

class initSeeder extends Seeder
{
    public function run()
    {
        \DB::table('ACCOUNTS')->insert([
            ['username'=>'teacher1', 'password'=>bcrypt('123456a@A'), 'acc_fullname'=>'Nguyen Van A', 'acc_email'=>'uchiha1610@gmail.com', 'acc_phone'=>'123456789', 'acc_role'=>'0'],
            ['username'=>'teacher2', 'password'=>bcrypt('123456a@A'), 'acc_fullname'=>'Nguyen Thi B', 'acc_email'=>'sharingan121@gmail.com','acc_phone'=>'123456789', 'acc_role'=>'0'],
            ['username'=>'student1', 'password'=>bcrypt('123456a@A'), 'acc_fullname'=>'Nguyen Van C', 'acc_email'=>'songoku1995@gmail.com', 'acc_phone'=>'123456789', 'acc_role'=>'1'],
            ['username'=>'student2', 'password'=>bcrypt('123456a@A'), 'acc_fullname'=>'Nguyen Thi D', 'acc_email'=>'bankai2020@gmail.com', 'acc_phone'=>'123456789', 'acc_role'=>'1']
        ]);
    }
}