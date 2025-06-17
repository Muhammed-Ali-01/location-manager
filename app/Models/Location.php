<?php

namespace App\Models;

use App\Helpers\DistanceHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /** @use HasFactory<\Database\Factories\LocationFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'color',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'latitude'  => 'float',
        'longitude' => 'float',
    ];





    public function calculateDistance(Location $location): float
    {
        return DistanceHelper::calculate($this->latitude, $this->longitude, $location->latitude, $location->longitude);
    }
}
