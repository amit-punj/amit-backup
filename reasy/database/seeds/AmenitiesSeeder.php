<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AmenitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
    	$amenities = [	'Wifi', 'Tables', 'Chairs', 'Fire extinguisher', 
    					'Heating', 'Air conditioner', 'Bar', 'Lounge', 
    					'Storage', 'Whiteboard', 'Near Public Transport',
    					'Penthouse', 'Office', 'Den/Library', 'Formal DiningRoom', 'pet friendly'
    				];
    	foreach ($amenities as $key => $amenity) {
    	    DB::table('amenities')->insert(['amenities_name' => $amenity]);
    	}
    	echo "Amenities Insert Successfully";
    }
}
