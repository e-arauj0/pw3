<?php

namespace App\Http\Controllers;

use App\Models\criptomoedas;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CriptomoedasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regBook = Criptomoedas::All();
        $contador = $regBook->count();

        return Response()->json($regBook);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validação de dados
        $validator = Validator::make($request->all(), [
            'sigla' => 'required',
            'nome' => 'required',
            'valor' => 'required'

        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registros inválidos',
                'errors' => $validator->errors()
            ], 400);
        }

        $registros = Criptomoedas::create($request->all());

        if ($registros) {
            return response()->json([
                'success' => true,
                'message' => 'criptomoeda cadastrada com sucesso!',
                'data' => $registros
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar a criptomoeda'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(criptomoedas $id)
    {
        $regBook = Criptomoedas::find($id);

        if($regBook){
            return 'Criptomoedas Localizadas: '.$regBook.Response()->json([],Response::HTTP_NO_CONTENT);
        } else {
            return 'Criptomoedas não localizadas. '.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'sigla' => 'required',
            'nome' => 'required',
            'valor' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registro inválidos',
                'errors' => $validator->errors()
            ], 400);
        }

        $regBookBanco->sigla = $request->sigla;
        $regBookBanco->nome = $request->nome;
        $regBookBanco->valor = $request->valor;

        if ($regBookBanco->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Criptomoedas atualizada com sucesso!',
                'data' => $regBookBanco
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar a criptomoeda'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $regBook = Criptomoedas::find($id);

        if (!$regBook) {
            return response()->json([
                'success' => false,
                'message' => 'criptomoeda não encontrada'
            ], 404);
        }

        if ($regBook->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'criptomoeda deletada com sucesso'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Erro ao deletar a criptomoeda'
        ], 500);
    }
}
