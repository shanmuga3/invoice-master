<?php

use Illuminate\Database\Seeder;

class EmailSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        DB::table('email_settings')->delete();
        DB::table('email_settings')->insert([
            ['name' => 'driver', 'value' => 'smtp'],
            ['name' => 'host', 'value' => 'smtp.gmail.com'],
            ['name' => 'port', 'value' => '25'],
            ['name' => 'from_address', 'value' => 'shanmmugarajan.33@gmail.com'],
            ['name' => 'from_name', 'value' => 'Invoice Master'],
            ['name' => 'encryption', 'value' => 'tls'],
            ['name' => 'username', 'value' => 'shanmmugarajan.33@gmail.com'],
            ['name' => 'password', 'value' => 'cclfsoqhjccqlake'],
        ]);

        DB::commit();
    }
}