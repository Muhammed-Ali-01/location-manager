<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{


    public function index(): JsonResponse
    {
        $locations = Location::all();
        return response()->json([
            'success' => true,
            'data'    => LocationResource::collection($locations),
        ]);
    }


    public function show(Location $location): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => new LocationResource($location),
        ]);
    }

    public function store(LocationRequest $request): JsonResponse
    {
        $location = Location::create($request->validated());
        return response()->json([
            'success' => true,
            'message' => __('Location created successfully'),
            'data'    => new LocationResource($location),
        ]);
    }
    public function update(LocationRequest $request, Location $location): JsonResponse
    {
        $location->update($request->validated());
        return response()->json([
            'success' => true,
            'message' => __('Location updated successfully'),
            'data'    => new LocationResource($location),
        ]);
    }

    public function destroy(Location $location): JsonResponse
    {
        $location->delete();
        return response()->json([
            'success' => true,
            'message' => __('Location deleted successfully'),
        ]);
    }



}
