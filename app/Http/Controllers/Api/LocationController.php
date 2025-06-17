<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationStoreRequest;
use App\Http\Requests\LocationUpdateRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    public function store(LocationStoreRequest $request): JsonResponse
    {
        $location = Location::create($request->validated());
        return response()->json([
            'success' => true,
            'message' => __('Location created successfully'),
            'data'    => new LocationResource($location),
        ]);
    }
    public function update(LocationUpdateRequest $request, Location $location): JsonResponse
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
