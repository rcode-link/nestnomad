<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = [
            [
                'name' => 'Sunny Hillside Apartment',
                'address' => [
                    'address' => '12 Hilltop Road',
                    'street' => 'Hilltop Road',
                    'postcode' => '71000',
                    'place' => 'Sarajevo',
                    'region' => 'Federation of BiH',
                    'country' => 'Bosnia and Herzegovina',
                    'placeName' => '12 Hilltop Road, 71000 Sarajevo, Bosnia and Herzegovina',
                    'coords' => [18.4131, 43.8563],
                ],
                'floor' => 3,
                'size' => 72.50,
                'rooms' => 3,
                'bathrooms' => 1,
                'heating' => 'central',
                'furnished' => true,
                'parking' => false,
                'elevator' => true,
                'balcony' => true,
                'year_built' => 2005,
                'description' => 'A bright and spacious apartment on the third floor with a south-facing balcony offering panoramic hillside views. Recently renovated with modern finishes, open-plan kitchen, and generous storage space.',
            ],
            [
                'name' => 'Riverside Studio',
                'address' => [
                    'address' => '45 Obala Kulina Bana',
                    'street' => 'Obala Kulina Bana',
                    'postcode' => '71000',
                    'place' => 'Sarajevo',
                    'region' => 'Federation of BiH',
                    'country' => 'Bosnia and Herzegovina',
                    'placeName' => '45 Obala Kulina Bana, 71000 Sarajevo, Bosnia and Herzegovina',
                    'coords' => [18.4264, 43.8586],
                ],
                'floor' => 1,
                'size' => 35.00,
                'rooms' => 1,
                'bathrooms' => 1,
                'heating' => 'gas',
                'furnished' => true,
                'parking' => false,
                'elevator' => false,
                'balcony' => false,
                'year_built' => 1998,
                'description' => 'Cozy studio apartment right along the Miljacka river. Perfect for a single tenant or couple. Fully furnished with a compact kitchen, built-in wardrobe, and river-facing windows.',
            ],
            [
                'name' => 'Old Town Loft',
                'address' => [
                    'address' => '8 Bascarsija Street',
                    'street' => 'Bascarsija Street',
                    'postcode' => '71000',
                    'place' => 'Sarajevo',
                    'region' => 'Federation of BiH',
                    'country' => 'Bosnia and Herzegovina',
                    'placeName' => '8 Bascarsija Street, 71000 Sarajevo, Bosnia and Herzegovina',
                    'coords' => [18.4314, 43.8598],
                ],
                'floor' => 2,
                'size' => 55.00,
                'rooms' => 2,
                'bathrooms' => 1,
                'heating' => 'electric',
                'furnished' => false,
                'parking' => false,
                'elevator' => false,
                'balcony' => true,
                'year_built' => 1975,
                'description' => 'Charming loft-style apartment in the heart of Bascarsija. High ceilings, exposed brick walls, and a small balcony overlooking the old bazaar. Walking distance to cafes, shops, and cultural landmarks.',
            ],
            [
                'name' => 'Mountain View Villa',
                'address' => [
                    'address' => '22 Trebevicka',
                    'street' => 'Trebevicka',
                    'postcode' => '71000',
                    'place' => 'Sarajevo',
                    'region' => 'Federation of BiH',
                    'country' => 'Bosnia and Herzegovina',
                    'placeName' => '22 Trebevicka, 71000 Sarajevo, Bosnia and Herzegovina',
                    'coords' => [18.4350, 43.8450],
                ],
                'floor' => 0,
                'size' => 180.00,
                'rooms' => 5,
                'bathrooms' => 3,
                'heating' => 'heat_pump',
                'furnished' => true,
                'parking' => true,
                'elevator' => false,
                'balcony' => true,
                'year_built' => 2018,
                'description' => 'Stunning detached villa at the foot of Mount Trebevic. Features a large garden, private parking for two cars, and breathtaking mountain views from every room. Energy-efficient heat pump system and modern smart home features.',
            ],
            [
                'name' => 'City Center Flat',
                'address' => [
                    'address' => '3 Marsala Tita',
                    'street' => 'Marsala Tita',
                    'postcode' => '71000',
                    'place' => 'Sarajevo',
                    'region' => 'Federation of BiH',
                    'country' => 'Bosnia and Herzegovina',
                    'placeName' => '3 Marsala Tita, 71000 Sarajevo, Bosnia and Herzegovina',
                    'coords' => [18.4138, 43.8590],
                ],
                'floor' => 5,
                'size' => 65.00,
                'rooms' => 2,
                'bathrooms' => 1,
                'heating' => 'central',
                'furnished' => false,
                'parking' => true,
                'elevator' => true,
                'balcony' => false,
                'year_built' => 2012,
                'description' => 'Modern two-bedroom flat on the main boulevard. Excellent public transport connections, underground parking included. Building has 24/7 security and a shared rooftop terrace.',
            ],
            [
                'name' => 'Mostar Bridge Residence',
                'address' => [
                    'address' => '15 Stari Most Street',
                    'street' => 'Stari Most Street',
                    'postcode' => '88000',
                    'place' => 'Mostar',
                    'region' => 'Herzegovina-Neretva',
                    'country' => 'Bosnia and Herzegovina',
                    'placeName' => '15 Stari Most Street, 88000 Mostar, Bosnia and Herzegovina',
                    'coords' => [17.8150, 43.3372],
                ],
                'floor' => 1,
                'size' => 90.00,
                'rooms' => 3,
                'bathrooms' => 2,
                'heating' => 'wood',
                'furnished' => true,
                'parking' => true,
                'elevator' => false,
                'balcony' => true,
                'year_built' => 1960,
                'description' => 'Traditional stone house residence just steps from the iconic Stari Most bridge. Beautifully restored with original stone details, wooden beams, and a private courtyard. Two balconies with views of the Neretva river.',
            ],
        ];

        foreach ($properties as $data) {
            \App\Models\Property::create(array_merge($data, ['public' => true]));
        }
    }
}
