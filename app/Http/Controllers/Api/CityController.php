<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\cities\StoreCityRequest;

class CityController extends Controller
{
    protected $model;

    public function __construct(City $model)
    {
      $this->model = $model;  
    }

    public function index() {
        $cities = $this->model::all();

        if(count($cities) > 0) {
            return response()->json([
                'status' => true,
                'cities' => $cities
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'No se econtraron ciudades registradas.',
            'cities' => $cities
        ], 404);
    }

    public function findCitiesWithStates() {
        $city = $this->model::records();

        if(!$city) {
            return response()->json([
                'status' => false,
                'message' => 'No se pudo crear correctamente la ciudad.',
                'city' => $city
            ], 404);
        }

        return response()->json([
            'status' => true,
            'city' => $city
        ], 200);
    }

    public function store(StoreCityRequest $request) {
        $params = $request->validated();

        $city = $this->model->create($params);

        if(!$city) {
            return response()->json([
                'status' => false,
                'message' => 'No se pudo crear correctamente la ciudad.',
                'city' => $city
            ], 404);
        } else {
            return response()->json([
                'status' => true,
                'city' => $city
            ], 200);
        }
    }
}
