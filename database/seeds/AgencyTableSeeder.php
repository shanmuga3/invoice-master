<?php

use Illuminate\Database\Seeder;

class AgencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        DB::table('agency_details')->delete();

        DB::table('agency_details')->insert([
            array('admin_id' => '1', 'name' => "Shan Agency", "address_line_1" => "sourashtra 1st colony", "address_line_2" => "Sakkimangalam", "city" => "Madurai", "state" => "Tamilnadu", "postal_code" => "625201", "country_code" => "IN", "contact_number" => "8754727065"),
        ]);

    	DB::commit();
    }
}
