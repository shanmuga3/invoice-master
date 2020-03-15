<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LaravelEntrustSeeder::class,
            SiteSettingsTableSeeder::class,
            EmailSettingsTableSeeder::class,
        ]);

        $this->call([
            AgencyTableSeeder::class,
            TaxTypesTableSeeder::class,
        ]);
    }
}
