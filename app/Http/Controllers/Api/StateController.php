<?php

namespace App\Http\Controllers\Api;

use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\states\StoreStateRequest;

class StateController extends Controller
{
    protected $model;

    public function __construct(State $model)
    {
        $this->model = $model;
    }

    public function index() {
        $states = $this->model::all();

        if(count($states) > 0) {
            $formattedStatus = $states->map(function ($state) {
                return [
                    'id' => $state->id,
                    'name_state' => $state->name_state
                ];
            });

            return response()->json([
                'status' => true,
                'states' => $formattedStatus
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No hay Estados/Provincias registrados aún.',
                'states' => $states
            ]);
        }
    }

    public function store(StoreStateRequest $request) {
        $params = $request->validated();

        $state = $this->model->create($params);

        if(!$state) {
            return response()->json([
                'status' => false,
                'message' => 'El nombre del Estado o Provincia es obligatario.',
                'state' => $state 
            ], 404);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Se creo exitosamente el Estado.',
                'state' => $state
            ], 200);
        }
    }

    public function show($id) {
        $state = $this->model->find($id);

        if(!$state) {
            return response()->json([
                'status' => false,
                'message' => 'No se encontro un Estado/Provincia con id: '.$id,
                'state' => $state
            ], 404);
        } else {
            return response()->json([
                'status' => true,
                'state' => $state
            ], 200);
        }
    }

    public function update(StoreStateRequest $request) {
        $params = $request->validated();

        $state = $this->model::where('id', $params['id'])->update($params);
        if($state) {
            return response()->json([
                'status' => true,
                'state' => $state
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No existe un id del estado: '.$params['id'],
                'state' => $state
            ], 404);
        }
    }
}
