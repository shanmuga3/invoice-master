<?php

use Illuminate\Database\Seeder;

class TaxTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        DB::table('tax_types')->delete();

        $date_time = date('Y-m-d H:i:s');

        DB::table('tax_types')->insert([
            array('agency_id' => '1','name' => 'VAT','type' => 'percent','value' => '10.00','description' => 'VAT','status' => '1','created_at' => $date_time,'updated_at' => $date_time),
            array('agency_id' => '1','name' => 'GST','type' => 'percent','value' => '5.00','description' => 'GST','status' => '1','created_at' => $date_time,'updated_at' => $date_time),
            array('agency_id' => '1','name' => 'WAT','type' => 'fixed','value' => '20.00','description' => 'WAT','status' => '1','created_at' => $date_time,'updated_at' => $date_time),
        ]);

    	DB::commit();
    }
}