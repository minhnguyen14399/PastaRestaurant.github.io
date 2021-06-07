<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Roles;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();

        $adminRoles = Roles::where('name','admin')->first();
        $quanlyRoles = Roles::where('name','quanly')->first();
        $nvbepRoles = Roles::where('name','nvbep')->first();
        $nvbanhangRoles = Roles::where('name','nvbanhang')->first();

        $admin = Admin::create([
            'admin_name' => 'Admin',
            'admin_email' => 'admin@gmail.com',
            'admin_phone' => '0342550714',
            'admin_password' => md5('123456')
        ]);
        $quanly = Admin::create([
            'admin_name' => 'Hoàng Huy',
            'admin_email' => 'huy@gmail.com',
            'admin_phone' => '0342550714',
            'admin_password' => md5('123456')
        ]);
        $nvbep = Admin::create([
            'admin_name' => 'Anh Minh',
            'admin_email' => 'minh@gmail.com',
            'admin_phone' => '0342550714',
            'admin_password' => md5('123456')
        ]);
        $nvbanhang = Admin::create([
            'admin_name' => 'Quang Nghĩa',
            'admin_email' => 'nghia@gmail.com',
            'admin_phone' => '0342550714',
            'admin_password' => md5('123456')
        ]);

        $admin->roles()->attach($adminRoles);
        $quanly->roles()->attach($quanlyRoles);
        $nvbep->roles()->attach($nvbepRoles);
        $nvbanhang->roles()->attach($nvbanhangRoles);
    }
}
