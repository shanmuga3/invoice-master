<?php

use Illuminate\Database\Seeder;

class SiteSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        DB::table('site_settings')->delete();
        DB::table('site_settings')->insert([
            ['name' => 'site_name', 'value' => 'Invoice Master'],
            ['name' => 'site_url', 'value' => ''],
            ['name' => 'version', 'value' => '1.0'],
            ['name' => 'admin_url', 'value' => 'admin'],
            ['name' => 'logo', 'value' => 'logo.png'],
            ['name' => 'favicon', 'value' => 'favicon.png'],
        ]);

        DB::commit();
    }
}