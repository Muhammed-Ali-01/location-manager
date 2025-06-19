<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $locations = [
        //     [
        //         'name'      => 'Fatih',
        //         'latitude'  => 41.0082,
        //         'longitude' => 28.9784,
        //         'color'     => '#FF0000',
        //     ],
        //     [
        //         'name'      => 'Taksim',
        //         'latitude'  => 41.0369,
        //         'longitude' => 28.9850,
        //         'color'     => '#00FF00',
        //     ],
        //     [
        //         'name'      => 'Kadıköy',
        //         'latitude'  => 40.9833,
        //         'longitude' => 29.0167,
        //         'color'     => '#0000FF',
        //     ],
        //     [
        //         'name'      => 'Beşiktaş',
        //         'latitude'  => 41.0422,
        //         'longitude' => 29.0094,
        //         'color'     => '#FFFF00',
        //     ],
        // ];

        $locations = [
            [
                'name' => 'İstanbul',
                'latitude' => 41.0082,
                'longitude' => 28.9784,
                'color' => '#FF0000',

            ],
            [
                'name' => 'Ankara',
                'latitude' => 39.9334,
                'longitude' => 32.8597,
                'color' => '#FF0000',
            ],
            [
                'name' => 'Kocaeli',
                'latitude' => 40.8533,
                'longitude' => 29.8815,
                'color' => '#00FF00',
            ],
            [
                'name' => 'Adana',
                'latitude' => 37.0000,
                'longitude' => 35.3213,
                'color' => '#0000FF',
            ],
            [
                'name' => 'Hakkari',
                'latitude' => 37.5744,
                'longitude' => 43.7408,
                'color' => '#FFFF00',
            ],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
