<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationStoreRequest;
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



}
