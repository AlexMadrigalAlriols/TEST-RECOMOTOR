<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cars\IndexRequest;
use App\Http\Requests\Cars\StoreRequest;
use App\Http\Requests\Cars\UpdateRequest;
use App\Http\Services\ApiResponse;
use App\Models\Car;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        $models = Car::get();

        return ApiResponse::ok("Data Found", $models);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        if($car = Car::create($request->validated())) {
            return ApiResponse::ok("Resource Created", $car);
        }

        return ApiResponse::bad("Error On Create Resource");
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return ApiResponse::ok("Data Found", $car);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Car $car)
    {
        $car->fill($request->validated());

        if($car->save()) {
            return ApiResponse::ok("Success Save");
        }

        return ApiResponse::bad("Error On Save Resource");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        if($car->delete()) {
            return ApiResponse::ok("Success Deleted");
        }

        return ApiResponse::bad("Error On Delete Resource");
    }
}
