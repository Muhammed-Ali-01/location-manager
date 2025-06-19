<?php

use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('can get routes from a location', function () {
    // Create a reference location
    $referenceLocation = Location::factory()->create([
        'longitude' => 0,
        'latitude'  => 0,
    ]);

    // Create some locations with varying distances
    Location::factory()->create([
        'longitude' => 10, // ~1113.2 km away
        'latitude' => 0,
        'name'      => 'Location 10km',
    ]);

    Location::factory()->create([
        'longitude' => 20, // ~2226.4 km away
        'latitude' => 0,
        'name'      => 'Location 20km',
    ]);

    Location::factory()->create([
        'longitude' => 5, // ~556.6 km away
        'latitude' => 0,
        'name'      => 'Location 5km',
    ]);

    $response = $this->get("/api/route/{$referenceLocation->id}");
    $response->assertOk();
    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'id',
                'name',
                'distance',
            ],
        ],
    ]);

    // Verify distances are calculated and sorted correctly
    $data      = $response->json('data');
    $distances = array_column($data, 'distance');
    $names     = array_column($data, 'name');

    // The distances should be sorted in ascending order
    $sortedDistances = $distances;
    sort($sortedDistances);
    $this->assertTrue($distances === $sortedDistances);
    // The closest location should be first
    $this->assertContains('Location 5km', $names);
    $this->assertContains('Location 10km', $names);
    $this->assertContains('Location 20km', $names);
});

test('fails when trying to get routes from non-existent location', function () {
    $response = $this->get('/api/route/999999');
    $response->assertNotFound();
});

test('returns empty array when no other locations exist', function () {
    $location = Location::factory()->create();

    $response = $this->get("/api/route/{$location->id}");
    $response->assertOk();
    $response->assertJson([
        'data' => [],
    ]);
});
