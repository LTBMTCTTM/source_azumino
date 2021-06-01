<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Str;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_admins')->insert(['admin_id' => 'admin','admin_name' => 'システム管理者', 'password' => Hash::make('admin2021')]);
        DB::table('m_admins')->insert(['admin_id' => 'staff01','admin_name' => '運用管理者①', 'password' => Hash::make('admin2021')]);
        DB::table('m_admins')->insert(['admin_id' => 'staff02','admin_name' => '運用管理者②', 'password' => Hash::make('admin2021')]);

    }
}
