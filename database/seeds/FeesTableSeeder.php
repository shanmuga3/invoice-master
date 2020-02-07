<?php

use Illuminate\Database\Seeder;

class FeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        DB::table('fees')->delete();

        DB::table('fees')->insert([
            array('name' => 'gst', 'value' => 10),
            array('name' => 'vat', 'value' => 10),
        ]);

    	DB::commit();
    }
}
