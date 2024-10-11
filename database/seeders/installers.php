<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Import DB facade


class installers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('installers')->insert([
            [
                'business_name' => 'Green Energy Solutions',
                'url' => 'green-energy-solutions',
                'email' => 'contact@greenenergy.com',
                'phone_number' => '01234 567890',
                'website_url' => 'https://www.greenenergy.com',
                'address_1' => '123 Solar St',
                'address_2' => null,
                'city' => 'Brighton',
                'county' => 'East Sussex',
                'postcode' => 'BN1 1AA',
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'business_name' => 'Eco Installers Inc.',
                'url' => 'eco-installers-inc',
                'email' => 'info@ecoinstallers.com',
                'phone_number' => '01234 678901',
                'website_url' => null,
                'address_1' => '456 Greenway Blvd',
                'address_2' => 'Unit 5',
                'city' => 'Manchester',
                'county' => 'Greater Manchester',
                'postcode' => 'M1 1AE',
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'business_name' => 'Solar Power Experts',
                'url' => 'solar-power-experts',
                'email' => 'support@solarpowerexperts.com',
                'phone_number' => '01234 789012',
                'website_url' => 'https://www.solarpowerexperts.com',
                'address_1' => '789 Energy Ave',
                'address_2' => 'Suite 101',
                'city' => 'Birmingham',
                'county' => 'West Midlands',
                'postcode' => 'B1 2AB',
                'status' => 'Disabled',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'business_name' => 'Renewable Tech Ltd.',
                'url' => 'renewable-tech-ltd',
                'email' => 'contact@renewabletech.com',
                'phone_number' => '01234 890123',
                'website_url' => 'https://www.renewabletech.com',
                'address_1' => '321 Clean St',
                'address_2' => null,
                'city' => 'Liverpool',
                'county' => 'Merseyside',
                'postcode' => 'L1 3CD',
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'business_name' => 'Future Energy',
                'url' => 'future-energy',
                'email' => 'hello@futureenergy.com',
                'phone_number' => '01234 901234',
                'website_url' => null,
                'address_1' => '654 Future Rd',
                'address_2' => null,
                'city' => 'Leeds',
                'county' => 'West Yorkshire',
                'postcode' => 'LS1 4EF',
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
