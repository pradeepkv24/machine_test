<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[[
            'name' => 'aneesh',
            'email' => 'aneesh@mail.com',
            'password' => bcrypt('123456'),
            'user_type'=>'customer',
            'mobile' => '9995759548',
        ],[
            'name' => 'syam',
            'email' => 'syam@mail.com',
            'password' => bcrypt('123456'),
            'user_type'=>'deliver',
            'mobile' => '9876543210',
        ],[
            'name' => 'sarath',
            'email' => 'sarath@mail.com',
            'password' => bcrypt('123456'),
            'user_type'=>'customer',
            'mobile' => '9876543211',
        ],[
            'name' => 'sam',
            'email' => 'sam@mail.com',
            'password' => bcrypt('123456'),
            'user_type'=>'customer',
            'mobile' => '9876543212',
        ],[
            'name' => 'nithin',
            'email' => 'nithin@mail.com',
            'password' => bcrypt('123456'),
            'user_type'=>'deliver',
            'mobile' => '9876543213',
        ],[
            'name' => 'sinto',
            'email' => 'sinto@mail.com',
            'password' => bcrypt('123456'),
            'user_type'=>'deliver',
            'mobile' => '9876543215',
        ]];
        User::insert($data);
        

    }
}
