<?php

namespace App\Http\Controllers;

use App\Models\celular;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CelularController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regBook = Celulars::All();
        $contador = $regBook->count();

        return Response()->json($regBook);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatorCelular = Validator::make($request->all(), [
            'modelo' => 'required',
            'memoria_ram' => 'required',
            'memoria_rom' => 'required'
        ]);

        if ($validatorCelular->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registros inválidos',
                'errors' => $validatorCelular->errors()
            ], 400);
        }

        // $validatorTbFornecedor = Validator::make($request->all(), [
        //     'nome' => 'required',
        //     'nacionalidade' => 'required',
        //     'linhas' => 'required'
        // ]);

        // if ($validatorTbFornecedor->fails()) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Registros inválidos',
        //         'errors' => $validator->errors()
        //     ], 400);
        // }

        $registros = Celulars::create($request->all());

        if ($registros) {
            return response()->json([
                'success' => true,
                'message' => 'celular cadastrado com sucesso!',
                'data' => $registros
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar o celular'
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(celular $id)
    {
        $regBook = Celulars::find($id);

        if($regBook){
            return 'celular localizado: '.$regBook.Response()->json([],Response::HTTP_NO_CONTENT);
        } else {
            return 'celular não localizado. '.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, celular $celular)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(celular $celular)
    {
        //
    }
}
