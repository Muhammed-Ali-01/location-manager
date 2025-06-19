<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\Http\Resources\RouteResource;
use App\Models\Location;
use Illuminate\Http\JsonResponse;

class RoutingController extends Controller
{
    public function index(Location $location): JsonResponse
    {
        $locations = Location::where('id', '!=', $location->id)->get();
        $locations->map(function (Location $tempLocation) use ($location) {
            $tempLocation->distance = $tempLocation->calculateDistance($location);
        });

        $locations = $locations->sortBy('distance');

        return response()->json([
            'success' => true,
            'referance_location' => new LocationResource($location),
            'data' => RouteResource::collection($locations),
        ]);
    }
}
