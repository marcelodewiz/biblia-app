<?php

namespace App\Http\Controllers;

use App\Models\Versiculo;
use Illuminate\Http\Request;

class VersiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Versiculo::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Versiculo::create($request->all());
    }

    public function show($versiculo)
    {
        $versiculo = Versiculo::find($versiculo);
        if($versiculo){
            $versiculo->livro;
            return $versiculo;
        }

        return response()->json([
            'message' =>'Erro ao pesquisar o versiculo.'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $versiculo)
    {
        $versiculo = Versiculo::findOrFail($versiculo);
        $versiculo->update($request->all());
        return $versiculo;
    }

    public function destroy($versiculo)
    {
        return Versiculo::destroy($versiculo);
    }
}
