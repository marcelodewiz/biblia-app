<?php

namespace App\Http\Controllers;

use App\Http\Resources\IdiomaResource;
use App\Models\Idioma;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IdiomaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Idioma::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Idioma::create($request->all())) {
            return response()->json([
                'message' => 'Idioma cadastrado com sucesso,'
            ], Response::HTTP_CREATED);
        }

        return response()->json([
            'message' => 'Erro ao cadastrar o idioma'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idioma)
    {
        $idioma = Idioma::with('versoes')->find($idioma);
        if ($idioma) {
            return new IdiomaResource($idioma);
        }

        return response()->json([
            'message' => 'Erro ao pesquisar o idioma'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idioma)
    {
        $idioma = Idioma::find($idioma);
        if ($idioma) {
            $idioma->update($request->all());

            return $idioma;
        }

        return response()->json([
            'message' => 'Erro ao atualizar o idioma'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idioma)
    {
        if (Idioma::destroy($idioma)) {
            return response()->json([
                'message' => ' Idioma deletado com sucesso.'
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => ' Erro ao deletar o Idioma.'
        ], Response::HTTP_NOT_FOUND);
    }
}
