<?php

use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

uses(RefreshDatabase::class);

test('can list all locations', function () {
    Location::factory(3)->create();
    
    $response = $this->get('/api/locations');
    $response->assertOk();
    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'id',
                'name',
                'longitude',
                'latitude',
                'color',
                'created_at',
                'updated_at',
            ]
        ]
    ]);
});

test('can view a specific location', function () {
    $location = Location::factory()->create();
    
    $response = $this->get("/api/locations/{$location->id}");
    $response->assertOk();
    
    $response->assertJsonStructure([
        'data' => [
            'id',
            'name',
            'longitude',
            'latitude',
            'color',
            'created_at',
            'updated_at',
        ]
    ]);
});

test('can create a new location', function () {
    $payload = [
        'name'      => fake()->name,
        'longitude' => fake()->randomFloat(-180, +180),
        'latitude'  => fake()->randomFloat(-90, +90),
        'color'     => fake()->hexColor(),
    ];
    
    $response = $this->post('/api/locations', $payload);
    $response->assertOk();
    $this->assertDatabaseHas('locations', $payload);
});

test('can update a location', function () {
    $location = Location::factory()->create();
    $payload = [
        'name'      => fake()->name,
        'longitude' => fake()->randomFloat(-180, +180),
        'latitude'  => fake()->randomFloat(-90, +90),
        'color'     => fake()->hexColor(),
    ];
    
    $response = $this->put("/api/locations/{$location->id}", $payload);
    $response->assertOk();
    $this->assertDatabaseHas('locations', $payload);

});

test('can delete a location', function () {
    $location = Location::factory()->create();
    
    $response = $this->delete("/api/locations/{$location->id}");
    $response->assertOk();
    $this->assertDatabaseMissing('locations',['id'=>$location->id] );
});

test('fails with validation errors when creating location with invalid data', function () {
    $payload = [
        'name'      => '', // Empty name
        'longitude' => 200, // Invalid longitude
        'latitude'  => 100, // Invalid latitude
        'color'     => 'invalid-color', // Invalid color
    ];
    
    $response = $this->post('/api/locations', $payload);
    $response->assertStatus(422);
    $response->assertJsonStructure([
        'data' => [
            'name',
            'longitude',
            'latitude',
            'color',
        ]
    ]);

});

test('fails with validation errors when updating location with invalid data', function () {
    $location = Location::factory()->create();
    $payload = [
        'name'      => '', // Empty name
        'longitude' => 200, // Invalid longitude
        'latitude'  => 100, // Invalid latitude
        'color'     => 'invalid-color', // Invalid color
    ];
    
    $response = $this->put("/api/locations/{$location->id}", $payload);
    $response->assertStatus(422);
    $response->assertJsonStructure([
        'data' => [
            'name',
            'longitude',
            'latitude',
            'color',
        ]
    ]);
});

test('fails when trying to view non-existent location', function () {
    $response = $this->get('/api/locations/999999');
    $response->assertNotFound();
});

test('fails when trying to update non-existent location', function () {
    $response = $this->put('/api/locations/999999', [
        'name' => 'Test',
    ]);
    $response->assertNotFound();
});

test('fails when trying to delete non-existent location', function () {
    $response = $this->delete('/api/locations/999999');
    $response->assertNotFound();
});

test('respects rate limiting', function () {
    $payload = [
        'name'      => fake()->name,
        'longitude' => fake()->randomFloat(-180, +180),
        'latitude'  => fake()->randomFloat(-90, +90),
        'color'     => fake()->hexColor(),
    ];
    
    for ($i = 0; $i < 11; $i++) {
        $response = $this->post('/api/locations', $payload);
        if ($i >= 10) {
            $response->assertTooManyRequests();
        } else {
            $response->assertOk();
        }
    }
});

